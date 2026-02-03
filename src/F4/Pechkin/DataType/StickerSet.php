<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PhotoSize,
    Sticker,
    Attribute\ArrayOf,
};

readonly class StickerSet extends AbstractDataType
{
    public function __construct(
        public readonly string $name,
        public readonly string $title,
        public readonly string $sticker_type,
        /** @var Sticker[] */
        #[ArrayOf(Sticker::class)]
        public readonly array $stickers,
        public readonly ?PhotoSize $thumbnail = null,
    ) {}
}
