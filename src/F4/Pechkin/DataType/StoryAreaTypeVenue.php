<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    StoryAreaType,
    Venue,
};

readonly class StoryAreaTypeVenue extends StoryAreaType
{
    public function __construct(
        public readonly Venue $venue,
    ) {}
}
