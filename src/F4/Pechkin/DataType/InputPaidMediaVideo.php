<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\InputPaidMedia;

readonly class InputPaidMediaVideo extends InputPaidMedia
{
    public readonly string $type;
    public function __construct(
        public readonly string $media,
        public readonly ?string $thumbnail = null,
        public readonly ?string $cover = null,
        public readonly ?int $start_timestamp = null,
        public readonly ?int $width = null,
        public readonly ?int $height = null,
        public readonly ?int $duration = null,
        public readonly ?bool $supports_streaming = null,
    ) {
        $this->type = 'video';
    }
}
