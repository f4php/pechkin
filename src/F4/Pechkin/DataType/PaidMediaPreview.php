<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\PaidMedia;

readonly class PaidMediaPreview extends PaidMedia
{
    public readonly string $type;
    public function __construct(
        public readonly ?int $width = null,
        public readonly ?int $height = null,
        public readonly ?int $duration = null,
    ) {
        $this->type = 'preview';
    }
}
