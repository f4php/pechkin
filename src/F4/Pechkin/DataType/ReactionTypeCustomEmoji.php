<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\ReactionType;

readonly class ReactionTypeCustomEmoji extends ReactionType
{
    public readonly string $type;
    public function __construct(
        public readonly string $custom_emoji_id,
    ) {
        $this->type = 'custom_emoji';
    }
}
