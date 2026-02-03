<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    ReactionType,
    ReactionTypeCustomEmoji,
    ReactionTypeEmoji,
    ReactionTypePaid,
    StoryAreaType,
    Attribute\Polymorphic,
};

readonly class StoryAreaTypeSuggestedReaction extends StoryAreaType
{
    public function __construct(
        #[Polymorphic([
            'custom_emoji' => ReactionTypeCustomEmoji::class,
            'emoji' => ReactionTypeEmoji::class,
            'paid' => ReactionTypePaid::class,
        ])]
        public readonly ReactionType $reaction_type,
        public readonly ?bool $is_dark = null,
        public readonly ?bool $is_flipped = null,
    ) {}
}
