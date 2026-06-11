<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichBlock,
    RichBlockCaption,
    Attribute\ArrayOf,
};

readonly class RichBlockSlideshow extends RichBlock
{
    public readonly string $type;
    public function __construct(
        /** @var RichBlock[] */
        #[ArrayOf(RichBlock::class)]
        public readonly array $blocks,
        public readonly RichBlockCaption $caption,
    ) {
        $this->type = 'slideshow';
    }
}
