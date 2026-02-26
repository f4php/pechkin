<?php

declare(strict_types=1);

namespace F4\Pechkin;

use Closure;
use RuntimeException;
use Composer\Pcre\Preg;

use function
    in_array,
    is_bool,
    mb_strlen,
    mb_substr;

final class When
{
    private readonly Closure $handler;
    private function __construct(
        Closure $handler,
        private readonly string|array|Closure|null $value = null,
    ) {
        $this->handler = $handler->bindTo($this);
    }
    public static function any(): static
    {
        return new static(handler: fn(): bool => true);
    }
    public static function callback(Closure $callback): static
    {
        return new static(
            handler: fn (string $subject): bool => 
                match(is_bool($result = ($this->value)($subject))) {
                    false => throw new RuntimeException('Closure in When::callback() must return boolean value'),
                    default => $result,
                },
            value: $callback,
        );
    }
    public static function equals(string $value): static
    {
        return new static(
            handler: fn (string $subject): bool => $subject === $this->value,
            value: $value,
        );
    }
    public static function matches(string $pattern): static
    {
        return new static(
            handler: fn (string $subject): bool => Preg::isMatch($this->value, $subject),
            value: $pattern,
        );
    }
    public static function oneOf(array $matches): static
    {
        return new static(
            handler: fn (string $subject): bool => in_array(needle: $subject, haystack: $this->value, strict: true),
            value: $matches,
        );
    }
    public static function startsWith(string $prefix): static
    {
        return new static(
            handler: fn (string $subject): bool => mb_substr(string: $subject, start: 0, length: mb_strlen($this->value)) === $this->value,
            value: $prefix,
        );
    }
    public function test(string $subject): bool
    {
        return (bool)($this->handler)($subject);
    }
}
