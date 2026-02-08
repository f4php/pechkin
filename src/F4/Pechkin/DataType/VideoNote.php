<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PhotoSize,
};

readonly class VideoNote extends AbstractDataType
{
    public function __construct(
        public readonly string $file_id,
        public readonly string $file_unique_id,
        public readonly int $length,
        public readonly int $duration,
        public readonly ?PhotoSize $thumbnail = null,
        public readonly ?string $file_size = null, // may not fit in a 32-bit integer
    ) {}
}
