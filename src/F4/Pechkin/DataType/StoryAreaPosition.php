<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class StoryAreaPosition extends AbstractDataType
{
    public function __construct(
        public readonly float $x_offset,
        public readonly float $y_offset,
        public readonly float $width,
        public readonly float $height,
        public readonly float $rotation_angle,
    ) {}
}
