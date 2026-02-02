<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Message,
    StarAmount,
};

readonly class SuggestedPostPaid extends AbstractDataType
{
    public function __construct(
        public readonly string $currency,
        public readonly ?Message $suggested_post_message = null,
        public readonly ?int $amount = null,
        public readonly ?StarAmount $star_amount = null,
    ) {}
}
