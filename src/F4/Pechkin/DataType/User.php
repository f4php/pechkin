<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class User extends AbstractDataType
{
    public function __construct(
        public readonly string $id, // may not fit in a 32-bit integer
        public readonly bool $is_bot,
        public readonly string $first_name,
        public readonly ?string $last_name = null,
        public readonly ?string $username = null,
        public readonly ?string $language_code = null,
        public readonly ?bool $is_premium = null,
        public readonly ?bool $added_to_attachment_menu = null,
        public readonly ?bool $can_join_groups = null,
        public readonly ?bool $can_read_all_group_messages = null,
        public readonly ?bool $supports_inline_queries = null,
        public readonly ?bool $can_connect_to_business = null,
        public readonly ?bool $has_main_web_app = null,
        public readonly ?bool $has_topics_enabled = null,

        // Undocumented property discoverd through API interaction
        public readonly ?bool $allows_users_to_create_topics = null,
    )
    {}
}
