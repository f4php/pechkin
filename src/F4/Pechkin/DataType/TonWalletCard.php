<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    TonWalletCardSticker,
    Attribute\ArrayOf,
};

readonly class TonWalletCard extends AbstractDataType
{
    public function __construct(
        public readonly string $address,
        public readonly string $amount, // decimal number as a string; may not fit in a 64-bit integer
        /** @var TonWalletCardSticker[] */
        #[ArrayOf(TonWalletCardSticker::class)]
        public readonly array $stickers,
        public readonly ?string $background_nft_address = null,
    ) {}
}
