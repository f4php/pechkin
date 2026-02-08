<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\InputPaidMedia;

readonly class InputPaidMediaPhoto extends InputPaidMedia
{
    public readonly string $type;
    public function __construct(
        public readonly string $media,
    ) {
        $this->type = 'photo';
    }
}
