<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    Sticker,
};

readonly class UniqueGift extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly Sticker $sticker,
        public readonly int $star_count,
        public readonly bool $is_premium,
        public readonly string $gift_id,
        public readonly bool $is_from_blockchain,
        public readonly ?int $total_count = null,
        public readonly ?int $remaining_count = null,
        public readonly ?string $colors = null,
        public readonly ?Chat $publisher_chat = null,
    ) {}
}
