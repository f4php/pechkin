<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Message,
    SuggestedPostPrice,
};

readonly class SuggestedPostApproved extends AbstractDataType
{
    public function __construct(
        public readonly int $send_date,
        public readonly ?Message $suggested_post_message = null,
        public readonly ?SuggestedPostPrice $price = null,
    ) {}
}
