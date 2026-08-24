<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichBlock,
    RichBlockTableCell,
    RichText,
    Attribute\ArrayOf,
};

readonly class RichBlockTable extends RichBlock
{
    public readonly string $type;
    public function __construct(
        /** @var array[] rows of RichBlockTableCell[] */
        #[ArrayOf(new ArrayOf(RichBlockTableCell::class))]
        public readonly array $cells,
        public readonly ?bool $is_bordered = null,
        public readonly ?bool $is_striped = null,
        public readonly ?bool $is_compact = null,
        /** @var RichText|RichText[]|string|null */
        #[ArrayOf(RichText::class)]
        public readonly RichText|array|string|null $caption = null,
    ) {
        $this->type = 'table';
    }
}
