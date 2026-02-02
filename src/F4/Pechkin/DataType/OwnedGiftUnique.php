<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    UniqueGift,
};

readonly class OwnedGiftUnique extends AbstractDataType
{
    public function __construct(
        public readonly UniqueGift $unique_gift,
        public readonly int $converted_star_count,
        public readonly string $owned_gift_id,
        public readonly ?string $sticker_color = null,
        public readonly ?string $last_resale_currency = null,
        public readonly ?int $last_resale_amount = null,
        public readonly ?int $next_transfer_date = null,
    ) {}
}
