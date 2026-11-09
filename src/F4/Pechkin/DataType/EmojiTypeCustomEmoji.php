<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\EmojiType;

readonly class EmojiTypeCustomEmoji extends EmojiType
{
    public readonly string $type;
    public function __construct(
        public readonly string $custom_emoji_id,
    ) {
        $this->type = 'custom_emoji';
    }
}
