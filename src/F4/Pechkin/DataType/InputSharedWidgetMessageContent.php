<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMessageContent,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class InputSharedWidgetMessageContent extends InputMessageContent
{
    public function __construct(
        public readonly string $widget_id,
        public readonly ?string $chat_data = null,
        public readonly ?string $caption = null,
        public readonly ?string $parse_mode = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $caption_entities = null,
        public readonly ?bool $show_caption_above_media = null,
    ) {}
}
