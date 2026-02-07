<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Sticker,
};

readonly class UniqueGiftModel extends AbstractDataType
{
    public function __construct(
        public readonly string $name,
        public readonly Sticker $sticker,
        public readonly int $rarity_per_mille,
    ) {}
}
