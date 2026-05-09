<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    PaidMedia,
    LivePhoto,
};

readonly class PaidMediaLivePhoto extends PaidMedia
{
    public readonly string $type;
    public function __construct(
        public readonly LivePhoto $live_photo,
    ) {
        $this->type = 'live_photo';
    }
}
