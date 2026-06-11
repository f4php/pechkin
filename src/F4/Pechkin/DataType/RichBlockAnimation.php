<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    Animation,
    RichBlock,
    RichBlockCaption,
};

readonly class RichBlockAnimation extends RichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly Animation $animation,
        public readonly ?bool $has_spoiler,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'animation';
    }
}
