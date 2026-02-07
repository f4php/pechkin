<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    Message,
};

use function in_array;

readonly class SuggestedPostRefunded extends AbstractDataType
{
    public function __construct(
        public readonly string $reason,
        public readonly ?Message $suggested_post_message = null,
    ) {
        if(!in_array(needle: $this->reason, haystack: ['post_deleted', 'payment_refunded'], strict: true)) {
            throw new InvalidArgumentException('Unsupported reason in '.__CLASS__);
        }
    }
}
