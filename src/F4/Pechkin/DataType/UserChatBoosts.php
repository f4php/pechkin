<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ChatBoost,
};

readonly class UserChatBoosts extends AbstractDataType
{
    public function __construct(
        /** @var ChatBoost[] */
        public readonly array $boosts,
    ) {}
}
