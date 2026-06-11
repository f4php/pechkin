<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichBlock,
    Attribute\ArrayOf,
};

readonly class RichBlockDetails extends RichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly RichBlock $summary,
        /** @var RichBlock[] */
        #[ArrayOf(RichBlock::class)]
        public readonly array $blocks,
        public readonly ?bool $is_open = null,
    ) {
        $this->type = 'details';
    }
}
