<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputRichBlock,
    RichText,
    Attribute\ArrayOf,
};

readonly class InputRichBlockDetails extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        /** @var RichText|RichText[]|string */
        #[ArrayOf(RichText::class)]
        public readonly RichText|array|string $summary,
        /** @var InputRichBlock[] */
        #[ArrayOf(InputRichBlock::class)]
        public readonly array $blocks,
        public readonly ?bool $is_open = null,
    ) {
        $this->type = 'details';
    }
}
