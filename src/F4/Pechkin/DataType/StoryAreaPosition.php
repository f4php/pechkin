<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class StoryAreaPosition extends AbstractDataType
{
    public function __construct(
        public readonly float $x_percentage,
        public readonly float $y_percentage,
        public readonly float $width_percentage,
        public readonly float $height_percentage,
        public readonly float $rotation_angle,
        public readonly float $corner_radius_percentage,
    ) {}
}
