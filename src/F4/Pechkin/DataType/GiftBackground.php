<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    BackgroundFill,
};

readonly class GiftBackground extends AbstractDataType
{
    public function __construct(
        public readonly string $type,
        public readonly BackgroundFill $fill,
        public readonly int $dark_theme_dimming,
    ) {}
}
