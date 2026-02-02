<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    File,
    MaskPosition,
    PhotoSize,
};

readonly class Sticker extends AbstractDataType
{
    public function __construct(
        public readonly string $file_id,
        public readonly string $file_unique_id,
        public readonly string $type,
        public readonly int $width,
        public readonly int $height,
        public readonly bool $is_animated,
        public readonly bool $is_video,
        public readonly ?PhotoSize $thumbnail = null,
        public readonly ?string $emoji = null,
        public readonly ?string $set_name = null,
        public readonly ?File $premium_animation = null,
        public readonly ?MaskPosition $mask_position = null,
        public readonly ?string $custom_emoji_id = null,
        public readonly ?bool $needs_repainting = null,
        public readonly ?string $file_size = null, // may not fit in a 32-bit integer
    ) {}
}
