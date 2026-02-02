<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Location,
};

readonly class BusinessLocation extends AbstractDataType
{
    public function __construct(
        public readonly string $address,
        public readonly ?Location $location = null,
    ) {}
}
