<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ChatShareThemeEmoji,
    ChatShareThemeUniqueGift,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'emoji' => ChatShareThemeEmoji::class,
    'unique_gift' => ChatShareThemeUniqueGift::class,
])]
abstract readonly class ChatShareTheme extends AbstractDataType
{
    public readonly string $type;
}
