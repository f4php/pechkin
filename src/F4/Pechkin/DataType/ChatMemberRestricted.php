<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    ChatMember,
    User,
};

readonly class ChatMemberRestricted extends ChatMember
{
    public readonly string $status;
    public function __construct(
        public readonly User $user,
        public readonly bool $is_member,
        public readonly bool $can_send_messages,
        public readonly bool $can_send_audios,
        public readonly bool $can_send_documents,
        public readonly bool $can_send_photos,
        public readonly bool $can_send_videos,
        public readonly bool $can_send_video_notes,
        public readonly bool $can_send_voice_notes,
        public readonly bool $can_send_polls,
        public readonly bool $can_send_other_messages,
        public readonly bool $can_add_web_page_previews,
        public readonly bool $can_change_info,
        public readonly bool $can_invite_users,
        public readonly bool $can_pin_messages,
        public readonly bool $can_manage_topics,
        public readonly int $until_date,
    ) {
        $this->status = 'restricted';
    }
}
