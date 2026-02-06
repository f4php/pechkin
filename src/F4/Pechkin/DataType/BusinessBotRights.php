<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class BusinessBotRights extends AbstractDataType
{
    public function __construct(
        public readonly ?bool $can_reply = null,
        public readonly ?bool $can_read_messages = null,
        public readonly ?bool $can_delete_sent_messages = null,
        public readonly ?bool $can_delete_all_messages = null,
        public readonly ?bool $can_edit_name = null,
        public readonly ?bool $can_edit_bio = null,
        public readonly ?bool $can_edit_profile_photo = null,
        public readonly ?bool $can_edit_username = null,
        public readonly ?bool $can_change_gift_settings = null,
        public readonly ?bool $can_view_gifts_and_stars = null,
        public readonly ?bool $can_convert_gifts_to_stars = null,
        public readonly ?bool $can_transfer_and_upgrade_gifts = null,
        public readonly ?bool $can_transfer_stars = null,
        public readonly ?bool $can_manage_stories = null,
    ) {}
}
