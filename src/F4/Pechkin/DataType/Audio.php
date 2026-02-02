<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;
use F4\Pechkin\DataType\{
    PhotoSize,
};

readonly class Audio extends AbstractDataType
{
    public function __construct(
        public readonly string $file_id,
        public readonly string $file_unique_id,
        public readonly int $duration,
        public readonly ?string $performer = null,
        public readonly ?string $title = null,
        public readonly ?string $file_name = null,
        public readonly ?string $mime_type = null,
        public readonly ?string $file_size = null,
        public readonly ?PhotoSize $thumbnail = null,
    ) {}
}
