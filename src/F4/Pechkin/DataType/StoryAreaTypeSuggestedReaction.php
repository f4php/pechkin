<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    ReactionType,
    StoryAreaType,
};

readonly class StoryAreaTypeSuggestedReaction extends StoryAreaType
{
    public function __construct(
        public readonly string $type,
        public readonly ReactionType $reaction_type,
        public readonly ?bool $is_dark = null,
        public readonly ?bool $is_flipped = null,
    ) {}
}
