<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMedia,
};

readonly class InputMediaVenue extends InputMedia
{
    public readonly string $type;
    public function __construct(
        float $latitude,
        float $longitude,
        string $title,
        string $address,
        ?string $foursquare_id = null,
        ?string $foursquare_type = null,
        ?string $google_place_id = null,
        ?string $google_place_type = null,
    ) {
        $this->type = 'venue';
    }
}
