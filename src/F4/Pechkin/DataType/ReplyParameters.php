<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class ReplyParameters extends AbstractDataType
{
    public function __construct(
        public readonly int $message_id,
        public readonly null|int|string $chat_id = null,
        public readonly ?bool $allow_sending_without_reply = null,
        public readonly ?string $quote = null, // Quoted part of the message to be replied to; 0-1024 characters after entities parsing. The quote must be an exact substring of the message to be replied to, including bold, italic, underline, strikethrough, spoiler, custom_emoji, and date_time entities. The message will fail to send if the quote isn't found in the original message.
        public readonly ?string $quote_parse_mode = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $quote_entities = null,
        public readonly ?int $quote_position = null,
        public readonly ?int $checklist_task_id = null,
        public readonly ?string $poll_option_id = null,
    ) {}
}
