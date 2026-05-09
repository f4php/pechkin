<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\InputPaidMedia;

readonly class InputPaidMediaLivePhoto extends InputPaidMedia
{
    public readonly string $type;
    public function __construct(
        public readonly string $media,
        public readonly string $photo,
    ) {
        $this->type = 'live_photo';
    }
}
