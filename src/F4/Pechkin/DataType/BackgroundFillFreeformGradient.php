<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BackgroundFill,
    Attribute\ArrayOf,
};

readonly class BackgroundFillFreeformGradient extends BackgroundFill
{
    public function __construct(
        /** @var int[] */
        #[ArrayOf('int')]
        public readonly array $colors,
    ) {}
}
