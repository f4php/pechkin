<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class LocationAddress extends AbstractDataType
{
    public function __construct(
        public readonly string $country_code,
        public readonly ?string $state = null,
        public readonly ?string $city = null,
        public readonly ?string $street = null,
    ) {}
}
