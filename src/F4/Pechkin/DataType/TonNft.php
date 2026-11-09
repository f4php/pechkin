<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    TonNftAttribute,
    UniqueGift,
    Attribute\ArrayOf,
};

readonly class TonNft extends AbstractDataType
{
    public function __construct(
        public readonly string $address,
        public readonly string $index, // decimal number as a string; may not fit in a 64-bit integer
        public readonly string $name,
        public readonly string $description,
        public readonly ?string $collection_address = null,
        /** @var TonNftAttribute[]|null */
        #[ArrayOf(TonNftAttribute::class)]
        public readonly ?array $attributes = null,
        public readonly ?UniqueGift $gift = null,
    ) {}
}
