<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMediaDocument,
    InputRichBlock,
    RichBlockCaption,
};

readonly class InputRichBlockDocument extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly InputMediaDocument $document,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'document';
    }
}
