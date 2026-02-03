<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
    Attribute\ArrayOf,
};

readonly class VideoChatParticipantsInvited extends AbstractDataType
{
    public function __construct(
        /** @var User[] */
        #[ArrayOf(User::class)]
        public readonly array $users,
    ) {}
}
