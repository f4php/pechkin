<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InlineKeyboardMarkup,
    InlineQueryResult,
    InputMessageContent,
    MessageEntity,
};

readonly class InlineQueryResultGif extends InlineQueryResult
{
    public function __construct(
        public readonly string $type,
        public readonly string $id,
        public readonly string $gif_url,
        public readonly string $thumbnail_url,
        public readonly ?int $gif_width = null,
        public readonly ?int $gif_height = null,
        public readonly ?int $gif_duration = null,
        public readonly ?string $thumbnail_mime_type = null,
        public readonly ?string $title = null,
        public readonly ?string $caption = null,
        public readonly ?string $parse_mode = null,
        /** @var MessageEntity[]|null */
        public readonly ?array $caption_entities = null,
        public readonly ?bool $show_caption_above_media = null,
        public readonly ?InlineKeyboardMarkup $reply_markup = null,
        public readonly ?InputMessageContent $input_message_content = null,
    ) {}
}
