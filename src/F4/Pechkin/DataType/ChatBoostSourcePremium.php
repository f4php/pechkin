<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    ChatBoostSource,
    User,
};

readonly class ChatBoostSourcePremium extends ChatBoostSource
{
    public function __construct(
        public readonly string $type,
        public readonly User $user,
    ) {}
}
