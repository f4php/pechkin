<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\RichText;

readonly class RichTextAnchorLink extends RichText
{
    public readonly string $type;
    public function __construct(
        public readonly RichText $text,
        public readonly string $anchor_name,
    ) {
        $this->type = 'anchor_link';
    }
}
