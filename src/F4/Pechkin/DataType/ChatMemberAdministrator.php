<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    ChatMember,
    User,
};

readonly class ChatMemberAdministrator extends ChatMember
{
    public readonly string $status;
    public function __construct(
        public readonly User $user,
        public readonly bool $can_be_edited,
        public readonly bool $is_anonymous,
        public readonly bool $can_manage_chat,
        public readonly bool $can_delete_messages,
        public readonly bool $can_manage_video_chats,
        public readonly bool $can_restrict_members,
        public readonly bool $can_promote_members,
        public readonly bool $can_change_info,
        public readonly bool $can_invite_users,
        public readonly bool $can_post_stories,
        public readonly bool $can_edit_stories,
        public readonly bool $can_delete_stories,
        public readonly ?bool $can_post_messages = null,
        public readonly ?bool $can_edit_messages = null,
        public readonly ?bool $can_pin_messages = null,
        public readonly ?bool $can_manage_topics = null,
        public readonly ?bool $can_manage_direct_messages = null,
        public readonly ?string $custom_title = null,

        // Undocumented property discoverd through API interaction
        public readonly ?bool $can_manage_voice_chats = null,
    ) {
        $this->status = 'administrator';
    }
}
