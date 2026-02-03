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
        public readonly ?string $quote = null,
        public readonly ?string $quote_parse_mode = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $quote_entities = null,
        public readonly ?int $quote_position = null,
        public readonly ?int $checklist_task_id = null,
    ) {}
}
