<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException,
    ReflectionClass,
    ReflectionNamedType,
    ReflectionType
;

use F4\Pechkin\DataType\{
    Attribute\ArrayOf,
    Attribute\Polymorphic,
};

use function
    array_map,
    array_reduce,
    get_object_vars,
    is_a,
    is_array
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
            $arrayOf = $parameter->getAttributes(ArrayOf::class)[0]?->newInstance();
            $polymorphic = $parameter->getAttributes(Polymorphic::class)[0]?->newInstance();
            if(self::checkIfTypeHas($type, 'array')) {
                if($arrayOf) {

                }
                else {

                }
            }
            elseif(self::checkIfTypeHas($type, AbstractDataType::class) && isset($data[$name])) {
                if($polymorphic) {

                }
                else {
                    $className = $type->getName();
                    $data[$name] = $className::fromArray(...$data[$name]??[]);
                }

            }
            // elseif ($type instanceof ReflectionUnionType) {
            //     if($className = self::TYPE_MAP[$data[$name][self::DISCRIMINATOR_NAME] ?? null] ?? null) {
            //         $data[$name] = $className::fromArray(...array_diff_key($data[$name]??[], [self::DISCRIMINATOR_NAME]));
            //     }
            // }
        }
        return new static(...$data);
    }

    private static function checkIfTypeHas(ReflectionType $haystack, string $needle): bool
    {
        return match(true) {
            $haystack instanceof ReflectionNamedType => match(true) {
                $haystack->isBuiltin() => $haystack->getName() === $needle,
                default => is_a($haystack->getName(), $needle),
            },
            $haystack instanceof ReflectionUnionType => array_reduce(
                array: $haystack->getTypes(),
                callback: fn(bool $carry, ReflectionType $type) => $carry || self::checkIfTypeHas($type, $needle),
                initial: false,
            ),
            $haystack instanceof ReflectionIntersectionType => array_reduce(
                array: $haystack->getTypes(),
                callback: fn(bool $carry, ReflectionType $type) => $carry && self::checkIfTypeHas($type, $needle),
                initial: false,
            ),
            default => false,
        };
    }

    private static function createInstance(ReflectionNamedType $type, array $data): AbstractDataType 
    {
        $className = $type->getName();
        return $className::fromArray(...$data);
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
