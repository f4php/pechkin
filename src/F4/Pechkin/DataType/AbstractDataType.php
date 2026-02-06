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
        if($polymorphic = ($reflection->getAttributes(Polymorphic::class)[0]??null)?->newInstance()) {
            return self::createFromPolymorphic($data, $polymorphic);
        }
        $constructor = $reflection->getConstructor();
        if ($constructor === null || $constructor->getNumberOfParameters() === 0) {
            if(!empty($data)) {
                throw new InvalidArgumentException('Cannot use supplied data with empty constructor');
            }
            return new static();
        }
        foreach ($constructor->getParameters() as $parameter) {
            $name = $parameter->getName();
            $type = $parameter->getType();
            $arrayOf = ($parameter->getAttributes(ArrayOf::class)[0]??null)?->newInstance();
            if (!isset($data[$name])) {
                continue;
            }

            if (self::checkIfTypeHas($type, 'array') && is_array($data[$name])) {
                if ($arrayOf) {
                    $data[$name] = array_map(
                        callback: fn($item) => self::createArrayOfType(data: $item, type: $arrayOf->type),
                        array: $data[$name],
                    );
                }
            } 
            elseif (self::checkIfTypeHas($type, AbstractDataType::class)) {
                if ($className = self::extractClassName($type, AbstractDataType::class)) {
                    $data[$name] = $className::fromArray($data[$name]);
                }
            }
            // attempt to cast types automatically
            elseif ($type instanceof ReflectionNamedType && $type->isBuiltin() && !empty($data[$name])) {
                $dataType = self::normalizeTypeName(gettype($data[$name]??null));
                if(!self::checkIfTypeHas($type, $dataType)) {
                    if(!settype($data[$name], $type->getName())) {
                        throw new InvalidArgumentException(sprintf('Failed to automatically cast value for "%s" from %s to %s ', $name, $dataType, $type->getName()));
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
        return match(true) {
            $haystack instanceof ReflectionNamedType => match(true) {
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

    private static function createArrayOfType(mixed $data, string $type): mixed
    {
        return match (true) {
            is_array($data) && is_a(
                object_or_class: $type,
                class: AbstractDataType::class,
                allow_string: true,
            ) => $type::fromArray($data),
            default => $data,
        };
    }

    private static function createFromPolymorphic(array $data, Polymorphic $polymorphic): AbstractDataType
    {
        $discriminatorValue = $data[$polymorphic->discriminator] ?? null;
        $className = $polymorphic->map[$discriminatorValue] ?? null;

        if ($className === null) {
            throw new InvalidArgumentException(
                "Unknown discriminator value '{$discriminatorValue}' for polymorphic type"
            );
        }
        // discriminator should not be passed to nested types
        unset($data[$polymorphic->discriminator]);
        return $className::fromArray($data);
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
    public function toArray(): array
    {
        $result = [];
        foreach (get_object_vars($this) as $property => $value) {
            $result[$property] = self::convertValue($value);
        }
        return $result;
    }

    /**
     * Convert a value to its array representation.
     * 
     * @param mixed $value
     * @return mixed
     */
    private static function convertValue(mixed $value): mixed
    {
        return match (true) {
            $value === null => null,
            $value instanceof AbstractDataType => $value->toArray(),
            is_array($value) => array_map(
                array: $value,
                callback: self::convertValue(...),
            ),
            default => $value,
        };
    }

}
