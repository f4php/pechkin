<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    MessageOriginChannel,
    MessageOriginChat,
    MessageOriginHiddenUser,
    MessageOriginUser,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'channel' => MessageOriginChannel::class,
    'chat' => MessageOriginChat::class,
    'hidden_user' => MessageOriginHiddenUser::class,
    'user' => MessageOriginUser::class,
])]
abstract readonly class MessageOrigin extends AbstractDataType
{
}
