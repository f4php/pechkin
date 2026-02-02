<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BackgroundFill,
};

readonly class BackgroundFillGradient extends BackgroundFill
{
    public function __construct(
        public readonly string $type,
        public readonly int $top_color,
        public readonly int $bottom_color,
        public readonly int $rotation_angle,
    ) {}
}
