<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    ChatInviteLink,
    User,
};

readonly class ChatJoinRequest extends AbstractDataType
{
    public function __construct(
        public readonly Chat $chat,
        public readonly User $from,
        public readonly string $user_chat_id, // may not fit in a 32-bit integer
        public readonly int $date,
        public readonly ?string $bio = null,
        public readonly ?ChatInviteLink $invite_link = null,
    ) {}
}
