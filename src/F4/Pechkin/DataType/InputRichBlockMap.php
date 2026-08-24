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
        public readonly ?int $zoom = null, // 0 - 24
        public readonly ?int $width = null, // 0 - 10000
        public readonly ?int $height = null, // 0 - 10000
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'map';
    }
}
