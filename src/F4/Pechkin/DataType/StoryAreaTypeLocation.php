<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    Location,
    StoryAreaType,
};

readonly class StoryAreaTypeLocation extends StoryAreaType
{
    public function __construct(
        public readonly string $type,
        public readonly Location $location,
    ) {}
}
