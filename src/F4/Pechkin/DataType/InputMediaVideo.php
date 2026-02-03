<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMedia,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class InputMediaVideo extends InputMedia
{
    public function __construct(
        public readonly string $media,
        public readonly ?string $thumbnail = null,
        public readonly ?string $caption = null,
        public readonly ?string $parse_mode = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $caption_entities = null,
        public readonly ?int $width = null,
        public readonly ?int $height = null,
        public readonly ?int $duration = null,
        public readonly ?bool $supports_streaming = null,
        public readonly ?bool $show_caption_above_media = null,
        public readonly ?bool $has_spoiler = null,
    ) {}
}
