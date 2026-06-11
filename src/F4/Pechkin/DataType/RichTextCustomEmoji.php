<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\RichText;

readonly class RichTextCustomEmoji extends RichText
{
    public readonly string $type;
    public function __construct(
        public readonly string $custom_emoji_id,
        public readonly string $alternative_text,
    ) {
        $this->type = 'custom_emoji';
    }
}
