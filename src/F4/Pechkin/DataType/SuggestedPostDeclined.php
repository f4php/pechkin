<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Message,
};

readonly class SuggestedPostDeclined extends AbstractDataType
{
    public function __construct(
        public readonly ?Message $suggested_post_message = null,
        public readonly ?string $comment = null,
    ) {}
}
