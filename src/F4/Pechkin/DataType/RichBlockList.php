<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichBlock,
    RichBlockListItem,
    Attribute\ArrayOf,
};

readonly class RichBlockList extends RichBlock
{
    public readonly string $type;
    public function __construct(
        /** @var RichBlockListItem[] */
        #[ArrayOf(RichBlockListItem::class)]
        public readonly array $items,
    ) {
        $this->type = 'list';
    }
}
