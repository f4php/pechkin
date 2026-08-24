<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichMessageButton,
    RichText,
};

readonly class RichTextButton extends RichText
{
    public readonly string $type;
    public function __construct(
        public readonly RichMessageButton $button,
    ) {
        $this->type = 'button';
    }
}
