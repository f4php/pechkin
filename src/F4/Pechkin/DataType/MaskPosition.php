<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class MaskPosition extends AbstractDataType
{
    public function __construct(
        public readonly string $point,
        public readonly float $x_shift,
        public readonly float $y_shift,
        public readonly float $scale,
    ) {}
}
