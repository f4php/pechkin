<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BackgroundFill,
};

readonly class BackgroundFillFreeformGradient extends BackgroundFill
{
    public function __construct(
        public readonly string $type,
        /** @var int[] */
        public readonly array $colors,
    ) {}
}
