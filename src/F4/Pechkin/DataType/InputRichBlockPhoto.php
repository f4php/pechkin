<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputRichBlock,
    InputMediaPhoto,
    RichBlockCaption,
};

readonly class InputRichBlockPhoto extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly InputMediaPhoto $photo,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'photo';
    }
}
