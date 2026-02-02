<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    ChatMember,
    User,
};

readonly class ChatMemberMember extends ChatMember
{
    public function __construct(
        public readonly string $status,
        public readonly User $user,
        public readonly ?int $until_date = null,
    ) {}
}
