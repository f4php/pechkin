<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\ReactionType;

readonly class ReactionTypeCustomEmoji extends ReactionType
{
    public function __construct(
        public readonly string $type,
        public readonly string $custom_emoji_id,
    ) {}
}
