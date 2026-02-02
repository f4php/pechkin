<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    ChatInviteLink,
    ChatMember,
    User,
};

readonly class ChatMemberUpdated extends AbstractDataType
{
    public function __construct(
        public readonly Chat $chat,
        public readonly User $from,
        public readonly int $date,
        public readonly ChatMember $old_chat_member,
        public readonly ChatMember $new_chat_member,
        public readonly ?ChatInviteLink $invite_link = null,
        public readonly ?bool $via_join_request = null,
        public readonly ?bool $via_chat_folder_invite_link = null,
    ) {}
}
