<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    Document,
    RichBlock,
    RichBlockCaption,
};

readonly class RichBlockDocument extends RichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly Document $document,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'document';
    }
}
