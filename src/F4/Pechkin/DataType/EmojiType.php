<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    EmojiTypeCustomEmoji,
    EmojiTypeEmoji,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'custom_emoji' => EmojiTypeCustomEmoji::class,
    'emoji' => EmojiTypeEmoji::class,
])]
abstract readonly class EmojiType extends AbstractDataType
{
    public readonly string $type;
}
