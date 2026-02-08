<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMedia,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class InputMediaAudio extends InputMedia
{
    public readonly string $type;
    public function __construct(
        public readonly string $media,
        public readonly ?string $thumbnail = null,
        public readonly ?string $caption = null,
        public readonly ?string $parse_mode = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $caption_entities = null,
        public readonly ?int $duration = null,
        public readonly ?string $performer = null,
        public readonly ?string $title = null,
    ) {
        $this->type = 'audio';
    }
}
