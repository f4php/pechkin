<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    LabeledPrice,
    Attribute\ArrayOf,
};

readonly class ShippingOption extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        /** @var LabeledPrice[] */
        #[ArrayOf(LabeledPrice::class)]
        public readonly array $prices,
    ) {}
}
