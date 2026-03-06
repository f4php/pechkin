<?php

declare(strict_types=1);

namespace F4\Pechkin;

use Closure;
use F4\Pechkin\{
    AbstractRoutable,
    RouterInterface,
    RouterTrait,
    ThenAwareTrait,
};

final class Flow extends AbstractRoutable implements RouterInterface
{
    use RouterTrait;
    use ThenAwareTrait;
    protected readonly Closure $handler;
    public const string STATE_SESSION_KEY = 'flow_state';
    protected function __construct(
        protected readonly Closure $matcher,
        public readonly int $priority = self::PRIORITY_NORMAL,
    ) {
        $this->handler = function(Context $context): mixed {
            $result = $this->dispatch($context);
            return array_reduce(
                callback: fn(mixed $result, Closure $handler) => $handler($context, $result),
                array: $this->thenHandlers,
                initial: $result
            );
        };
    }
    public static function getState(): null
    {
        return $_SESSION[self::STATE_SESSION_KEY] ?? null;
    }
    public static function resetState(): null
    {
        unset($_SESSION[self::STATE_SESSION_KEY]);
        return null;
    }
    public static function setState(string $name): null
    {
        $_SESSION[self::STATE_SESSION_KEY] = $name;
        return null;
    }
    public static function when(Closure $matcher): static
    {
        return new static(
            matcher: $matcher,
            priority: self::PRIORITY_HIGH,
        );
    }
    public static function whenInState(string $state): static
    {
        return new static(
            matcher: function() use ($state) {return static::getState() === $state;},
            priority: self::PRIORITY_HIGH,
        );
    }
}
