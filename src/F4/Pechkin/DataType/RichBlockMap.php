<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    Location,
    RichBlock,
    RichBlockCaption,
};

readonly class RichBlockMap extends RichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly Location $location,
        public readonly int $zoom, // 13 - 20
        public readonly int $width,
        public readonly int $height,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'map';
    }
}
