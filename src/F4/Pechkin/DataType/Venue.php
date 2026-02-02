<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Location,
};

readonly class Venue extends AbstractDataType
{
    public function __construct(
        public readonly Location $location,
        public readonly string $title,
        public readonly string $address,
        public readonly ?string $foursquare_id = null,
        public readonly ?string $foursquare_type = null,
        public readonly ?string $google_place_id = null,
        public readonly ?string $google_place_type = null,
    ) {}
}
