<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichText,
    User,
};

readonly class RichTextTextMention extends RichText
{
    public readonly string $type;
    public function __construct(
        public readonly RichText $text,
        public readonly User $user,
    ) {
        $this->type = 'text_mention';
    }
}
