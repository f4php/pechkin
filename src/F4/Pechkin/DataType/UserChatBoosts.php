<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ChatBoost,
    Attribute\ArrayOf,
};

readonly class UserChatBoosts extends AbstractDataType
{
    public function __construct(
        /** @var ChatBoost[] */
        #[ArrayOf(ChatBoost::class)]
        public readonly array $boosts,
    ) {}
}
