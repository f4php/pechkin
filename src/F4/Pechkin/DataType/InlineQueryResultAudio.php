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

readonly class InlineQueryResultAudio extends InlineQueryResult
{
    public function __construct(
        public readonly string $id,
        public readonly string $audio_url,
        public readonly string $title,
        public readonly ?string $caption = null,
        public readonly ?string $parse_mode = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $caption_entities = null,
        public readonly ?string $performer = null,
        public readonly ?int $audio_duration = null,
        public readonly ?InlineKeyboardMarkup $reply_markup = null,
        public readonly ?InputMessageContent $input_message_content = null,
    ) {}
}
