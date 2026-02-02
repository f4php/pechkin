<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException,
    ReflectionClass,
    ReflectionNamedType,
    ReflectionType
;

use function
    array_diff_key,
    array_map,
    count,
    get_object_vars,
    is_a,
    is_array
;

abstract readonly class AbstractDataType
{
    protected const string DISCRIMINATOR_NAME = 'type';
    protected const array TYPE_MAP = [];
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
            if($type instanceof ReflectionNamedType) {
                $className = $type->getName();
                if(is_a($className, AbstractDataType::class, true)) {
                    $data[$name] = $className::fromArray(...$data[$name]??[]);
                }
            }
            elseif ($type instanceof ReflectionUnionType) {
                if($className = self::TYPE_MAP[$data[$name][self::DISCRIMINATOR_NAME] ?? null] ?? null) {
                    $data[$name] = $className::fromArray(...array_diff_key($data[$name]??[], [self::DISCRIMINATOR_NAME]));
                }
            }
        }
        return new static(...$data);
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
            $result[$property] = $this->convertValue($value);
        }

        return $result;
    }

    /**
     * Convert a value to its array representation.
     * 
     * @param mixed $value
     * @return mixed
     */
    private function convertValue(mixed $value): mixed
    {
        return match (true) {
            $value === null => null,
            $value instanceof AbstractDataType => $value->toArray(),
            is_array($value) => array_map(
                array: $value,
                callback: $this->convertValue(...),
            ),
            default => $value,
        };
    }

}
