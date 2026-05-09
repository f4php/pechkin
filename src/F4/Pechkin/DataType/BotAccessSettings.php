<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
    Attribute\ArrayOf,
};

readonly class BotAccessSettings extends AbstractDataType
{
    public function __construct(
        public readonly bool $is_access_restricted,
        /** @var User[]|null */
        #[ArrayOf(User::class)]
        public readonly ?array $added_users = null,
    ) {}
}
