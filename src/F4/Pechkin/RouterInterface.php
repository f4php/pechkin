<?php

declare(strict_types=1);

namespace F4\Pechkin;

use F4\Pechkin\{
    AbstractRoutable,
};

interface RouterInterface
{
    public function dispatch(Context $context): mixed;
    public function register(AbstractRoutable ...$routables): static;
}
