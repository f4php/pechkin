<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
};

readonly class ManagedBotUpdated extends AbstractDataType
{
    public function __construct(
        public readonly User $user,
        public readonly User $bot,
    ) {}
}
