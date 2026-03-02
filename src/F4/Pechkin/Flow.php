<?php

declare(strict_types=1);

namespace F4\Pechkin;

use Closure;
use F4\Pechkin\{
    AbstractRoutable,
    RouterInterface,
    RouterTrait,
};

final class Flow extends AbstractRoutable implements RouterInterface
{
    use RouterTrait;

    protected function __construct(
        protected readonly Closure $matcher,
        public readonly int $priority = self::PRIORITY_NORMAL,
    ) {
        $this->handler = $this->dispatch(...);
    }
    public static function when(Closure $matcher): static
    {
        return new static(
            matcher: $matcher,
            priority: self::PRIORITY_HIGHEST,
        );
    }
}
