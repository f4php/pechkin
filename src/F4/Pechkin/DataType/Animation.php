<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PhotoSize,
};

readonly class Animation extends AbstractDataType
{
    public function __construct(
        public readonly string $file_id,
        public readonly string $file_unique_id,
        public readonly int $width,
        public readonly int $height,
        public readonly int $duration,
        public readonly ?PhotoSize $thumbnail = null,
        public readonly ?string $file_name = null,
        public readonly ?string $mime_type = null,
        public readonly ?string $file_size = null, // may not fit in a 32-bit integer
    ) {}
}
