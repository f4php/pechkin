<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class ChatPermissions extends AbstractDataType
{
    public function __construct(
        public readonly ?bool $can_send_messages = null,
        public readonly ?bool $can_send_audios = null,
        public readonly ?bool $can_send_documents = null,
        public readonly ?bool $can_send_photos = null,
        public readonly ?bool $can_send_videos = null,
        public readonly ?bool $can_send_video_notes = null,
        public readonly ?bool $can_send_voice_notes = null,
        public readonly ?bool $can_send_polls = null,
        public readonly ?bool $can_send_other_messages = null,
        public readonly ?bool $can_add_web_page_previews = null,
        public readonly ?bool $can_change_info = null,
        public readonly ?bool $can_invite_users = null,
        public readonly ?bool $can_pin_messages = null,
        public readonly ?bool $can_manage_topics = null,

        // Undocumented property discoverd through API interaction
        public readonly ?bool $can_send_media_messages = null,
    ) {}
}
