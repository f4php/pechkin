<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputRichBlock,
    RichBlockCaption,
    Attribute\ArrayOf,
};

readonly class InputRichBlockSlideshow extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        /** @var InputRichBlock[] */
        #[ArrayOf(InputRichBlock::class)]
        public readonly array $blocks,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'slideshow';
    }
}
