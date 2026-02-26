<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ChatMemberAdministrator,
    ChatMemberBanned,
    ChatMemberLeft,
    ChatMemberMember,
    ChatMemberOwner,
    ChatMemberRestricted,
    Attribute\Polymorphic,
};

#[Polymorphic(
    discriminator: 'status',
    map: [
        'administrator' => ChatMemberAdministrator::class,
        'creator' => ChatMemberOwner::class,
        'kicked' => ChatMemberBanned::class,
        'left' => ChatMemberLeft::class,
        'member' => ChatMemberMember::class,
        'restricted' => ChatMemberRestricted::class,
    ],
)]
abstract readonly class ChatMember extends AbstractDataType
{
    public readonly string $status;
}
