<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ReactionTypeCustomEmoji,
    ReactionTypeEmoji,
    ReactionTypePaid,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'custom_emoji' => ReactionTypeCustomEmoji::class,
    'emoji' => ReactionTypeEmoji::class,
    'paid' => ReactionTypePaid::class,
])]
abstract readonly class ReactionType extends AbstractDataType
{
}
