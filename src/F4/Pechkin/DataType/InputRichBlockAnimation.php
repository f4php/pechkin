<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMediaAnimation,
    InputRichBlock,
    RichBlockCaption,
};

readonly class InputRichBlockAnimation extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly InputMediaAnimation $animation,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'animation';
    }
}
