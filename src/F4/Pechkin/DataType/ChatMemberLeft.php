<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    ChatMember,
    User,
};

readonly class ChatMemberLeft extends ChatMember
{
    public readonly string $status;
    public function __construct(
        public readonly User $user,
    ) {
        $this->status = 'left';
    }
}
