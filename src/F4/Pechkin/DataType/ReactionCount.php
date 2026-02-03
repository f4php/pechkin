<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ReactionType,
    ReactionTypeCustomEmoji,
    ReactionTypeEmoji,
    ReactionTypePaid,
    Attribute\Polymorphic,
};

readonly class ReactionCount extends AbstractDataType
{
    public function __construct(
        #[Polymorphic([
            'custom_emoji' => ReactionTypeCustomEmoji::class,
            'emoji' => ReactionTypeEmoji::class,
            'paid' => ReactionTypePaid::class,
        ])]
        public readonly ReactionType $type,
        public readonly int $total_count,
    ) {}
}
