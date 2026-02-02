<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    SuggestedPostPrice,
};

readonly class SuggestedPostInfo extends AbstractDataType
{
    public function __construct(
        public readonly string $state, 	// 	State of the suggested post. Currently, it can be one of “pending”, “approved”, “declined”.
        public readonly ?SuggestedPostPrice $price = null,
        public readonly ?int $send_date = null,
    ) {}
}
