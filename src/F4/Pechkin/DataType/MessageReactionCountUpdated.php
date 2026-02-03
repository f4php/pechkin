<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    ReactionCount,
    Attribute\ArrayOf,
};

readonly class MessageReactionCountUpdated extends AbstractDataType
{
    public function __construct(
        public readonly Chat $chat,
        public readonly int $message_id,
        public readonly int $date,
        /** @var ReactionCount[] */
        #[ArrayOf(ReactionCount::class)]
        public readonly array $reactions,
    ) {}
}
