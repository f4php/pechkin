<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    ChatMember,
    User,
};

readonly class ChatMemberOwner extends ChatMember
{
    public function __construct(
        public readonly User $user,
        public readonly bool $is_anonymous,
        public readonly ?string $custom_title = null,
    ) {}
}
