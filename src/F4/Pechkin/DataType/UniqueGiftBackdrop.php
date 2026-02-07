<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    UniqueGiftBackdropColors,
};

readonly class UniqueGiftBackdrop extends AbstractDataType
{
    public function __construct(
        public readonly string $name,
        public readonly UniqueGiftBackdropColors $colors,
        public readonly int $rarity_per_mille,
    ) {}
}
