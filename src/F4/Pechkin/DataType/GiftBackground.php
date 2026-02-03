<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
};

readonly class GiftBackground extends AbstractDataType
{
    public function __construct(
        public readonly int $center_color,
        public readonly int $edge_color,
        public readonly int $text_color,
    ) {}
}
