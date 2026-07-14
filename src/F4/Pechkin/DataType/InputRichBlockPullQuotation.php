<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\Attribute\ArrayOf;

use F4\Pechkin\DataType\{
    InputRichBlock,
    RichText,
};

readonly class InputRichBlockPullQuotation extends InputRichBlock
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
        $this->type = 'pullquote';
    }
}
