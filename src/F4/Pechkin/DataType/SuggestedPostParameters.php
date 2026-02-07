<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    SuggestedPostPrice,
};

readonly class SuggestedPostParameters extends AbstractDataType
{
    public function __construct(
        public readonly ?SuggestedPostPrice $price = null,
        public readonly ?int $send_date = null,
    ) {}
}
