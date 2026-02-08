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
    public readonly string $type;
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly InputMessageContent $input_message_content,
        public readonly ?InlineKeyboardMarkup $reply_markup = null,
        public readonly ?string $url = null,
        public readonly ?string $description = null,
        public readonly ?string $thumbnail_url = null,
        public readonly ?int $thumbnail_width = null,
        public readonly ?int $thumbnail_height = null,
    ) {
        $this->type = 'article';
    }
}
