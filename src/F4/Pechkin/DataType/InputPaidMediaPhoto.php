<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\InputPaidMedia;

readonly class InputPaidMediaPhoto extends InputPaidMedia
{
    public function __construct(
        public readonly string $type,
        public readonly string $media,
    ) {}
}
