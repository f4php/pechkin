<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BackgroundFill,
    BackgroundType,
};

readonly class BackgroundTypeFill extends BackgroundType
{
    public function __construct(
        public readonly BackgroundFill $fill,
        public readonly int $dark_theme_dimming,
    ) {}
}
