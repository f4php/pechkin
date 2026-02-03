<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InlineKeyboardMarkup,
    InlineQueryResult,
    InputMessageContent,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class InlineQueryResultCachedVideo extends InlineQueryResult
{
    public function __construct(
        public readonly string $id,
        public readonly string $video_file_id,
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?string $caption = null,
        public readonly ?string $parse_mode = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $caption_entities = null,
        public readonly ?bool $show_caption_above_media = null,
        public readonly ?InlineKeyboardMarkup $reply_markup = null,
        public readonly ?InputMessageContent $input_message_content = null,
    ) {}
}
