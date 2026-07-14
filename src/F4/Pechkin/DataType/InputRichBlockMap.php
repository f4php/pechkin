<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputRichBlock,
    Location,
    RichBlockCaption,
};

readonly class InputRichBlockMap extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly Location $location,
        public readonly int $zoom, // 0 - 24
        public readonly int $width,
        public readonly int $height,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'map';
    }
}
