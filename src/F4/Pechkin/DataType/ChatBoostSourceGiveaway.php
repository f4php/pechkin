<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    ChatBoostSource,
    User,
};

readonly class ChatBoostSourceGiveaway extends ChatBoostSource
{
    public function __construct(
        public readonly string $type,
        public readonly int $giveaway_message_id,
        public readonly ?User $user = null,
        public readonly ?bool $is_unclaimed = null,
    ) {}
}
