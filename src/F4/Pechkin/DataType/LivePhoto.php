<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PhotoSize,
    Attribute\ArrayOf,
};

readonly class LivePhoto extends AbstractDataType
{
    public function __construct(
        public readonly string $file_id,
        public readonly string $file_unique_id,
        public readonly int $width,
        public readonly int $height,
        public readonly int $duration,
        /** @var PhotoSize[]|null */
        #[ArrayOf(PhotoSize::class)]
        public readonly ?array $photo = null,
        public readonly ?string $mime_type = null,
        public readonly ?string $file_size = null, // may not fit in a 32-bit integer
    ) {}
}
