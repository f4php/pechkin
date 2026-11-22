<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Attribute\ArrayOf,
};

readonly class BotFullInfo extends AbstractDataType
{
    public function __construct(
        public readonly string $id, // may not fit in a 32-bit integer
        public readonly bool $is_bot,
        public readonly string $first_name,
        public readonly bool $can_join_groups,
        public readonly bool $can_read_all_group_messages,
        public readonly bool $supports_guest_queries,
        public readonly bool $supports_inline_queries,
        public readonly bool $needs_inline_query_location,
        public readonly bool $can_connect_to_business,
        public readonly bool $has_main_web_app,
        public readonly bool $has_topics_enabled,
        public readonly bool $allows_users_to_create_topics,
        public readonly bool $has_topic_sidebar,
        public readonly bool $can_manage_bots,
        public readonly bool $supports_join_request_queries,
        public readonly ?string $username = null,
        /** @var string[]|null */
        #[ArrayOf('string')]
        public readonly ?array $active_usernames = null,
        public readonly ?string $inline_query_placeholder = null,
    ) {}
}
