<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException,
    ReflectionClass,
    ReflectionNamedType,
    ReflectionType,
    ReflectionUnionType
;

use F4\Pechkin\{
    CanExpandDataTypesTrait,
    DataType\Attribute\ArrayOf,
    DataType\Attribute\Polymorphic,
};

use function
    array_diff_key,
    array_intersect_key,
    array_is_list,
    array_map,
    array_reduce,
    get_object_vars,
    gettype,
    is_a,
    is_array,
    settype,
    sprintf
;

abstract readonly class AbstractDataType
{
    use CanExpandDataTypesTrait;
    public function __construct(...$args) {}
    /**
     * Register a handler that receives deserialization warnings (unknown
     * properties, unresolvable polymorphic discriminators). Pass null to reset
     * to the default behaviour, which is trigger_error(..., E_USER_WARNING).
     */
    public static function setWarningHandler(?callable $handler): void
    {
        DeserializationWarnings::setHandler($handler);
    }
    /**
     * Emit a deserialization warning. Routed through the registered handler when
     * one is set, otherwise raised as an E_USER_WARNING so it surfaces in logs
     * and test runners without aborting deserialization.
     */
    public static function warn(string $message): void
    {
        DeserializationWarnings::emit($message);
    }
    private static function checkIfTypeHas(ReflectionType $haystack, string $needle): bool
    {
        return match (true) {
            $haystack instanceof ReflectionNamedType => match (true) {
                    $haystack->isBuiltin() => $haystack->getName() === $needle,
                    default => is_a($haystack->getName(), $needle, allow_string: true),
                },
            $haystack instanceof ReflectionUnionType => array_reduce(
                array: $haystack->getTypes(),
                callback: fn(bool $carry, ReflectionType $type) => $carry || self::checkIfTypeHas($type, $needle),
                initial: false,
            ),
            // $haystack instanceof ReflectionIntersectionType => array_reduce(
            //     array: $haystack->getTypes(),
            //     callback: fn(bool $carry, ReflectionType $type) => $carry && self::checkIfTypeHas($type, $needle),
            //     initial: false,
            // ),
            default => false,
        };
    }
    private static function createArrayOfType(array $data, string|ArrayOf $type): array
    {
        return array_map(
            array: $data,
            callback: match(true) {
                $type instanceof ArrayOf =>
                    fn(mixed $item): array => self::createArrayOfType(data: (array)$item, type: $type->type),
                is_a(
                    object_or_class: $type,
                    class: AbstractDataType::class,
                    allow_string: true,
                ) =>
                    // scalar items pass through unchanged: e.g. an Array of RichText
                    // may mix RichText objects with plain strings
                    fn(mixed $item): mixed => is_array($item) ? ($type)::fromArray($item) : $item,
                default =>
                    fn(mixed $item): mixed => $item,
            },
        );
    }
    private static function extractClassName(?ReflectionType $type, string $needle): ?string
    {
        return match (true) {
            $type instanceof ReflectionNamedType => match (true) {
                    !$type->isBuiltin() && is_a($type->getName(), class: $needle, allow_string: true) => $type->getName(),
                    default => null,
                },
            $type instanceof ReflectionUnionType => array_reduce(
                array: $type->getTypes(),
                callback: fn(?string $carry, ReflectionType $t) => $carry ?? self::extractClassName($t, $needle),
                initial: null,
            ),
            default => null,
        };
    }
    /**
     * Create an instance from an array of data.
     *
     * Declared as self (not static) because polymorphic union bases such as
     * InputPollMedia and InputPollOptionMedia dispatch to sibling InputMedia*
     * subtypes that do not extend the base they are dispatched from.
     *
     * Returns null when dispatching a polymorphic base whose discriminator value
     * is unknown (e.g. a subtype introduced by a newer API version): the caller
     * then leaves the corresponding field null rather than crashing.
     *
     * @param array<string, mixed> $data
     * @return static|null
     */
    public static function fromArray(array $data): ?self
    {
        $reflection = new ReflectionClass(static::class);
        if ($polymorphic = ($reflection->getAttributes(Polymorphic::class)[0] ?? null)?->newInstance()) {
            return $polymorphic->createFromArray($data);
        }
        $constructor = $reflection->getConstructor();
        if ($constructor === null || $constructor->getNumberOfParameters() === 0) {
            // Tolerate upstream API additions to a previously field-less object:
            // warn about the unknown keys instead of throwing.
            self::warnAboutUnknownProperties($data, []);
            return new static();
        }
        $knownNames = [];
        foreach ($constructor->getParameters() as $parameter) {
            $name = $parameter->getName();
            $knownNames[$name] = true;
            $type = $parameter->getType();
            $arrayOf = ($parameter->getAttributes(ArrayOf::class)[0] ?? null)?->newInstance();
            if (!isset($data[$name])) {
                continue;
            }
            // a list is an "Array of X"; an associative array is a single object —
            // both can be valid for union-typed fields such as RichText|array|string
            if (self::checkIfTypeHas($type, 'array') && is_array($data[$name]) && array_is_list($data[$name]) && $arrayOf) {
                $data[$name] = self::createArrayOfType(data: $data[$name], type: $arrayOf->type);
            }
            elseif (self::checkIfTypeHas($type, AbstractDataType::class) && is_array($data[$name]) && ($className = self::extractClassName($type, AbstractDataType::class))) {
                $data[$name] = $className::fromArray($data[$name]);
            }
            // attempt to cast types automatically
            elseif ($type instanceof ReflectionNamedType && $type->isBuiltin() && !empty($data[$name])) {
                $dataType = self::normalizeTypeName(gettype($data[$name] ?? null));
                if (!self::checkIfTypeHas($type, $dataType)) {
                    if (!settype($data[$name], $type->getName())) {
                        throw new InvalidArgumentException(sprintf("Failed to automatically cast value for '%s' from %s to %s", $name, $dataType, $type->getName()));
                    }
                }
            }
        }
        // Drop properties the constructor does not declare so that new fields
        // introduced by an upstream API change cannot crash deserialization.
        self::warnAboutUnknownProperties($data, $knownNames);
        $data = array_intersect_key($data, $knownNames);
        return new static(...$data);
    }
    /**
     * Emit a warning for every key in $data that is not a known constructor
     * parameter name.
     *
     * @param array<string, mixed> $data
     * @param array<string, true> $knownNames
     */
    private static function warnAboutUnknownProperties(array $data, array $knownNames): void
    {
        foreach (array_diff_key($data, $knownNames) as $key => $_) {
            self::warn(sprintf('Pechkin: ignoring unknown property "%s" for %s', $key, static::class));
        }
    }
    private static function normalizeTypeName(string $type): ?string
    {
        return [
            'boolean' => 'bool',
            'integer' => 'int',
            'double' => 'float',
        ][$type] ?? $type;
    }
    /**
     * Convert the DataType object to an array representation.
     *
     * @return array<string, mixed>
     */
    public function toArray(bool $compact = false): array
    {
        return self::expandAsArray(value: get_object_vars($this), compact: $compact);
    }
}
