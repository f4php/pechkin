<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use Closure;

use function trigger_error;

use const E_USER_WARNING;

/**
 * Holds the mutable warning sink used during deserialization.
 *
 * Kept separate from AbstractDataType because that class is `readonly`, which
 * forbids a writable static property for the handler.
 */
final class DeserializationWarnings
{
    private static ?Closure $handler = null;

    public static function setHandler(?callable $handler): void
    {
        self::$handler = $handler === null ? null : Closure::fromCallable($handler);
    }

    public static function emit(string $message): void
    {
        if (self::$handler !== null) {
            (self::$handler)($message);
            return;
        }
        trigger_error($message, E_USER_WARNING);
    }
}
