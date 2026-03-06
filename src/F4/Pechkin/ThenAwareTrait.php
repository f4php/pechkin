<?php

declare(strict_types=1);

namespace F4\Pechkin;

use Closure;

trait ThenAwareTrait
{
    protected array $thenHandlers = [];
    public function then(Closure $handler): static
    {
        $this->thenHandlers[] = $handler;
        return $this;
    }
}
