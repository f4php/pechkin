<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    SuggestedPostPrice,
};

use function in_array;

readonly class SuggestedPostInfo extends AbstractDataType
{
    public function __construct(
        public readonly string $state,
        public readonly ?SuggestedPostPrice $price = null,
        public readonly ?int $send_date = null,
    ) {
        if(!in_array(needle: $this->state, haystack: ['pending', 'approved', 'declined'], strict: true)) {
            throw new InvalidArgumentException('Unsupported '.__CLASS__.' state');
        }
    }
}
