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

readonly class InlineQueryResultMpeg4Gif extends InlineQueryResult
{
    public readonly string $type;
    public function __construct(
        public readonly string $id,
        public readonly string $mpeg4_url,
        public readonly string $thumbnail_url,
        public readonly ?int $mpeg4_width = null,
        public readonly ?int $mpeg4_height = null,
        public readonly ?int $mpeg4_duration = null,
        public readonly ?string $thumbnail_mime_type = null,
        public readonly ?string $title = null,
        public readonly ?string $caption = null,
        public readonly ?string $parse_mode = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $caption_entities = null,
        public readonly ?bool $show_caption_above_media = null,
        public readonly ?InlineKeyboardMarkup $reply_markup = null,
        public readonly ?InputMessageContent $input_message_content = null,
    ) {
        $this->type = 'mpeg4_gif';
    }
}
