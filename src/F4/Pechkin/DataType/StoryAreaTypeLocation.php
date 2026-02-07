<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    LocationAddress,
    StoryAreaType,
};

readonly class StoryAreaTypeLocation extends StoryAreaType
{
    public function __construct(
        public readonly float $latitude,
        public readonly float $longitude,
        public readonly ?LocationAddress $address = null,
    ) {}
}
