<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputRichBlock,
    RichText,
    Attribute\ArrayOf,
};

readonly class InputRichBlockExpandableBlockQuotation extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        /** @var RichText|RichText[]|string */
        #[ArrayOf(RichText::class)]
        public readonly RichText|array|string $text,
        /** @var RichText|RichText[]|string|null */
        #[ArrayOf(RichText::class)]
        public readonly RichText|array|string|null $credit = null,
    ) {
        $this->type = 'expandable_blockquote';
    }
}
