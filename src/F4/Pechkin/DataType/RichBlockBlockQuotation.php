<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichBlock,
    RichText,
    Attribute\ArrayOf,
};

readonly class RichBlockBlockQuotation extends RichBlock
{
    public readonly string $type;
    public function __construct(
        /** @var RichBlock[] */
        #[ArrayOf(RichBlock::class)]
        public readonly array $blocks,
        /** @var RichText|RichText[]|string|null */
        #[ArrayOf(RichText::class)]
        public readonly RichText|array|string|null $credit = null,
    ) {
        $this->type = 'blockquote';
    }
}
