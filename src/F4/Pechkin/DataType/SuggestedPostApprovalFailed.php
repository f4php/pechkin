<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Message,
    SuggestedPostPrice,
};

readonly class SuggestedPostApprovalFailed extends AbstractDataType
{
    public function __construct(
        public readonly SuggestedPostPrice $price,
        public readonly ?Message $suggested_post_message = null,
    ) {}
}
