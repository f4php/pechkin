<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\StoryAreaType;

readonly class StoryAreaTypeWeather extends StoryAreaType
{
    public function __construct(
        public readonly float $temperature,
        public readonly string $emoji,
        public readonly int $background_color,
    ) {}
}
