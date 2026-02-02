<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Message,
};

readonly class SuggestedPostRefunded extends AbstractDataType
{
    public function __construct(
        public readonly string $reason,
        public readonly ?Message $suggested_post_message = null,
    ) {}
}
