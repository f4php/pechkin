<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
};

readonly class BusinessConnection extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly User $user,
        public readonly string $user_chat_id, // may not fit in a 32-bit integer
        public readonly int $date,
        public readonly bool $can_reply,
        public readonly bool $is_enabled,
    ) {}
}
