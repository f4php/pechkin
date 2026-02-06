<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    ReactionType,
    User,
    Attribute\ArrayOf,
};

readonly class MessageReactionUpdated extends AbstractDataType
{
    public function __construct(
        public readonly Chat $chat,
        public readonly int $message_id,
        public readonly int $date,
        /** @var ReactionType[] */
        #[ArrayOf(ReactionType::class)]
        public readonly array $old_reaction,
        /** @var ReactionType[] */
        #[ArrayOf(ReactionType::class)]
        public readonly array $new_reaction,
        public readonly ?User $user = null,
        public readonly ?Chat $actor_chat = null,
    ) {}
}
