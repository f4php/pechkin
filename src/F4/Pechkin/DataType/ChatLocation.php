<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Location,
};

readonly class ChatLocation extends AbstractDataType
{
    public function __construct(
        public readonly Location $location,
        public readonly string $address,
    ) {}
}
