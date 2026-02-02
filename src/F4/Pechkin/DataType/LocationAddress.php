<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class LocationAddress extends AbstractDataType
{
    public function __construct(
        public readonly string $country_code,
        public readonly string $state,
        public readonly string $city,
        public readonly string $street_line1,
        public readonly string $street_line2,
    ) {}
}
