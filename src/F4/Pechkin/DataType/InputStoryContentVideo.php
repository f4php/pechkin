<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\InputStoryContent;

readonly class InputStoryContentVideo extends InputStoryContent
{
    public function __construct(
        public readonly string $video,
    ) {}
}
