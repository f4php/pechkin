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

readonly class InlineQueryResultDocument extends InlineQueryResult
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly string $document_url,
        public readonly string $mime_type,
        public readonly ?string $caption = null,
        public readonly ?string $parse_mode = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $caption_entities = null,
        public readonly ?string $description = null,
        public readonly ?InlineKeyboardMarkup $reply_markup = null,
        public readonly ?InputMessageContent $input_message_content = null,
        public readonly ?string $thumbnail_url = null,
        public readonly ?int $thumbnail_width = null,
        public readonly ?int $thumbnail_height = null,
    ) {}
}
