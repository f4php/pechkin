<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMedia,
    MessageEntity,
};

readonly class InputMediaPhoto extends InputMedia
{
    public function __construct(
        public readonly string $type,
        public readonly string $media,
        public readonly ?string $caption = null,
        public readonly ?string $parse_mode = null,
        /** @var MessageEntity[]|null */
        public readonly ?array $caption_entities = null,
        public readonly ?bool $show_caption_above_media = null,
        public readonly ?bool $has_spoiler = null,
    ) {}
}
