<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    PaidMedia,
    Video,
};

readonly class PaidMediaVideo extends PaidMedia
{
    public readonly string $type;
    public function __construct(
        public readonly Video $video,
    ) {
        $this->type = 'video';
    }
}
