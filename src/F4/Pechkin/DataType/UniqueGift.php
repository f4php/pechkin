<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    UniqueGiftBackdrop,
    UniqueGiftColors,
    UniqueGiftModel,
    UniqueGiftSymbol,
};

readonly class UniqueGift extends AbstractDataType
{
    public function __construct(
        public readonly string $gift_id,
        public readonly string $base_name,
        public readonly string $name,
        public readonly int $number,
        public readonly UniqueGiftModel $model,
        public readonly UniqueGiftSymbol $symbol,
        public readonly UniqueGiftBackdrop $backdrop,
        public readonly ?bool $is_premium = null,
        public readonly ?bool $is_from_blockchain = null,
        public readonly ?UniqueGiftColors $colors = null,
        public readonly ?Chat $publisher_chat = null,
    ) {}
}
