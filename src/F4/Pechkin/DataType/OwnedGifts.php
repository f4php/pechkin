<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    OwnedGift,
    Attribute\ArrayOf,
};

readonly class OwnedGifts extends AbstractDataType
{
    public function __construct(
        public readonly int $total_count,
        /** @var OwnedGift[] */
        #[ArrayOf(OwnedGift::class)]
        public readonly array $gifts,
        public readonly ?string $next_offset = null,
    ) {}
}
