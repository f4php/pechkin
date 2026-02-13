<?php

declare(strict_types=1);

namespace F4\Pechkin;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputFile,
};

use function
    array_filter,
    array_map,
    is_array,
    json_encode
;

trait CanExpandDataTypesTrait
{
    protected static function expandAsArray(mixed $value, bool $compact): mixed
    {
        // Compact strips null values
        return match (true) {
            $value instanceof AbstractDataType => $value->toArray(compact: $compact),
            is_array($value) => match ($compact) {
                true => array_filter(
                    array: array_map(
                        array: $value,
                        callback: fn(mixed $item): mixed => self::expandAsArray(value: $item, compact: $compact),
                    ),
                    callback: fn(mixed $item): bool => $item !== null,
                ),
                default => array_map(
                    array: $value,
                    callback: fn(mixed $item): mixed => self::expandAsArray(value: $item, compact: $compact),
                ),
            },
            default => $value,
        };
    }
    protected static function expandAsMultipartFormData(array $value, bool $compact): array
    {
        $result = array_map(
            fn(string $key, mixed $value): ?array =>
                match(true) {
                    $value instanceof InputFile => [
                        'name' => $key,
                        'contents' => $value->content,
                        'filename' => $value->filename,
                    ],
                    $value instanceof AbstractDataType => [
                        'name' => $key,
                        'contents' => json_encode($value->toArray()),
                    ],
                    is_array($value) => [
                        'name' => $key,
                        'contents' => json_encode($value),
                        'headers' => [
                            'Content-Type' => 'application/json; charset=utf-8',
                        ],
                    ],
                    $value === null && $compact => null,
                    default => [
                        'name' => $key,
                        'contents' => $value,
                    ],
                },
            array_keys($value),
            array_values($value),
        );
        return match($compact) {
            true => array_filter($result),
            default => $result,
        };
    }
}