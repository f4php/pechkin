<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputRichBlock,
    InputRichBlockListItem,
    Attribute\ArrayOf,
};

readonly class InputRichBlockList extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        /** @var InputRichBlockListItem[] */
        #[ArrayOf(InputRichBlockListItem::class)]
        public readonly array $items,
    ) {
        $this->type = 'list';
    }
}
