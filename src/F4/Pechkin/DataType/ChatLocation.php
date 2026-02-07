<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    Location,
};

use function mb_strlen;

readonly class ChatLocation extends AbstractDataType
{
    public function __construct(
        public readonly Location $location,
        public readonly string $address,
    ) {
        if (mb_strlen($this->address) > 64) {
            throw new InvalidArgumentException('Address length cannot exceed 64 characters');
        }
    }
}
