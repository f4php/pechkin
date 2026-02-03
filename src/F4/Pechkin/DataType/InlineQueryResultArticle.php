<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InlineKeyboardMarkup,
    InlineQueryResult,
    InputMessageContent,
};

readonly class InlineQueryResultArticle extends InlineQueryResult
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        // TODO:
        // InputMessageContent is polymorphic by design, but it doesn't follow the same convention as other polymorphic types and 
        // does not support 'type' property for children types
        // 
        // This needs further investigation
        //
        public readonly InputMessageContent $input_message_content,
        public readonly ?InlineKeyboardMarkup $reply_markup = null,
        public readonly ?string $url = null,
        public readonly ?bool $hide_url = null,
        public readonly ?string $description = null,
        public readonly ?string $thumbnail_url = null,
        public readonly ?int $thumbnail_width = null,
        public readonly ?int $thumbnail_height = null,
    ) {}
}
