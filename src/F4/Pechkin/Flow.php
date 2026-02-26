<?php

declare(strict_types=1);

namespace F4\Pechkin;

use Closure;
use F4\Pechkin\{
    AbstractRoutable,
    Context,
    RouterInterface,
    RouterTrait,
};

final class Flow extends AbstractRoutable implements RouterInterface
{
    use RouterTrait;
    public static function when(Closure $matcher): static
    {
        return new static(
            matcher: $matcher,
            handler: fn(Context $ctx) => $this->dispatch($ctx),
            priority: self::PRIORITY_HIGHEST,
        );
    }
}
