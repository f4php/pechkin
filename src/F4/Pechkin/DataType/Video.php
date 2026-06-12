<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PhotoSize,
    VideoQuality,
    Attribute\ArrayOf,
};

readonly class Video extends AbstractDataType
{
    public function __construct(
        public readonly string $file_id,
        public readonly string $file_unique_id,
        public readonly int $width,
        public readonly int $height,
        public readonly int $duration,
        public readonly ?PhotoSize $thumbnail = null,
        public readonly ?PhotoSize $thumb = null, // this property is not documented, but returned by the API alongside $thumbnail
        /** @var PhotoSize[]|null */
        #[ArrayOf(PhotoSize::class)]
        public readonly ?array $cover = null,
        public readonly ?int $start_timestamp = null,
        #[ArrayOf(VideoQuality::class)]
        public readonly ?array $qualities = null,
        public readonly ?string $file_name = null,
        public readonly ?string $mime_type = null,
        public readonly ?string $file_size = null, // may not fit in a 32-bit integer
    ) {}
}
