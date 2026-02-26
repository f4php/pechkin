<?php

declare(strict_types=1);

namespace F4\Pechkin;

use F4\Pechkin\{
    AbstractRoutable,
    Context,
};

use function usort;

trait RouterTrait
{
    protected array $routables = [];
    public function register(AbstractRoutable ...$routables): static
    {
        foreach ($routables as $routable) {
            $this->routables[] = $routable;
        }
        return $this;
    }
    public function dispatch(Context $context): mixed
    {
        usort(
            array: $this->routables,
            callback: fn(AbstractRoutable $a, AbstractRoutable $b): int => $b->priority <=> $a->priority,
        );
        foreach ($this->routables as $routable) {
            if ($routable->checkMatch($context)) {
                return $routable->invoke($context);
            }
        }
        return null;
    }
}
