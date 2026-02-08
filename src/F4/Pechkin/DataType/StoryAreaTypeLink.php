<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\StoryAreaType;

readonly class StoryAreaTypeLink extends StoryAreaType
{
    public readonly string $type;
    public function __construct(
        public readonly string $url,
    ) {
        $this->type = 'link';
    }
}
