<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\InputStoryContent;

readonly class InputStoryContentVideo extends InputStoryContent
{
    public function __construct(
        public readonly string $video,
        public readonly ?float $duration = null,
        public readonly ?float $cover_frame_timestamp =null,
        public readonly ?bool $is_animation = null,
    ) {}
}
