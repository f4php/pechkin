<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
};

readonly class ChatInviteLink extends AbstractDataType
{
    public function __construct(
        public readonly string $invite_link,
        public readonly User $creator,
        public readonly bool $creates_join_request,
        public readonly bool $is_primary,
        public readonly bool $is_revoked,
        public readonly ?string $name = null,
        public readonly ?int $expire_date = null,
        public readonly ?int $member_limit = null,
        public readonly ?int $pending_join_request_count = null,
        public readonly ?int $subscription_period = null,
        public readonly ?int $subscription_price = null,
    ) {}
}
