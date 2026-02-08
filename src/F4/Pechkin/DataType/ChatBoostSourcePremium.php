<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    ChatBoostSource,
    User,
};

readonly class ChatBoostSourcePremium extends ChatBoostSource
{
    public readonly string $source;
    public function __construct(
        public readonly User $user,
    ) {
        $this->source = 'premium';
    }
}
