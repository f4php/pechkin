<?php

declare(strict_types=1);

namespace F4\Pechkin;

use F4\Pechkin\DataType\AbstractDataType;

use function
    array_filter,
    array_map,
    is_array;

trait CanExpandDataTypesTrait
{
    protected static function expandDataTypes(mixed $value, bool $compact): mixed
    {
        // Compact strips null values
        return match (true) {
            $value instanceof AbstractDataType => $value->toArray(compact: $compact),
            is_array($value) => match ($compact) {
                true => array_filter(
                    array: array_map(
                        array: $value,
                        callback: fn(mixed $item): mixed => self::expandDataTypes(value: $item, compact: $compact),
                    ),
                    callback: fn(mixed $item): bool => $item !== null,
                ),
                default => array_map(
                    array: $value,
                    callback: fn(mixed $item): mixed => self::expandDataTypes(value: $item, compact: $compact),
                ),
            },
            default => $value,
        };

        // return $result;
    }
}