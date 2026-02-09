<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException,
    ReflectionClass,
    ReflectionNamedType,
    ReflectionType,
    ReflectionUnionType
;

use F4\Pechkin\DataType\{
    Attribute\ArrayOf,
    Attribute\Polymorphic,
};

use function
    array_filter,
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
    public function __construct(...$args) {}
    /**
     * Create an instance from an array of data.
     *
     * @param array<string, mixed> $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        $reflection = new ReflectionClass(static::class);
        if ($polymorphic = ($reflection->getAttributes(Polymorphic::class)[0] ?? null)?->newInstance()) {
            return $polymorphic->createFromArray($data);
        }
        $constructor = $reflection->getConstructor();
        if ($constructor === null || $constructor->getNumberOfParameters() === 0) {
            if (!empty($data)) {
                throw new InvalidArgumentException('Cannot use supplied data with empty constructor for '.static::class);
            }
            return new static();
        }
        foreach ($constructor->getParameters() as $parameter) {
            $name = $parameter->getName();
            $type = $parameter->getType();
            $arrayOf = ($parameter->getAttributes(ArrayOf::class)[0] ?? null)?->newInstance();
            if (!isset($data[$name])) {
                continue;
            }
            if (self::checkIfTypeHas($type, 'array') && is_array($data[$name]) && $arrayOf) {
                $data[$name] = self::createArrayOfType(data: $data[$name], type: $arrayOf->type);
            } 
            elseif (self::checkIfTypeHas($type, AbstractDataType::class) && ($className = self::extractClassName($type, AbstractDataType::class))) {
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
        return new static(...$data);
    }

    private static function normalizeTypeName(string $type): ?string
    {
        return [
            'boolean' => 'bool',
            'integer' => 'int',
            'double' => 'float',
        ][$type] ?? $type;
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
                    fn(mixed $item): mixed => $type::fromArray((array)$item),
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
     * Convert the DataType object to an array representation.
     *
     * @return array<string, mixed>
     */
    public function toArray(bool $compact = false): array
    {
        $result = (array)self::convertValue(get_object_vars($this), $compact);
        return match($compact) {
            true => array_filter(
                array: $result,
                callback: fn(mixed $item): bool => $item !== null,
            ),
            default => $result,
        };
    }

    /**
     * Convert a value to its array representation.
     * 
     * @param mixed $value
     * @return mixed
     */
    private static function convertValue(mixed $value, bool $compact = false): mixed
    {
        return match (true) {
            $value === null => null,
            $value instanceof AbstractDataType => $value->toArray($compact),
            is_array($value) => array_map(
                array: $value,
                callback: fn($item) => self::convertValue($item, $compact),
            ),
            default => $value,
        };
    }

}
