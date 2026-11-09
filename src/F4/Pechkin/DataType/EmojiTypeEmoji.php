<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\EmojiType;

readonly class EmojiTypeEmoji extends EmojiType
{
    public readonly string $type;
    public function __construct(
        public readonly string $emoji,
    ) {
        $this->type = 'emoji';
    }
}
