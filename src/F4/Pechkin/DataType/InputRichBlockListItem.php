<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputRichBlock,
    Attribute\ArrayOf,
};

readonly class InputRichBlockListItem extends AbstractDataType
{
    public function __construct(
        /** @var InputRichBlock[] */
        #[ArrayOf(InputRichBlock::class)]
        public readonly array $blocks,
        public readonly ?bool $has_checkbox = null,
        public readonly ?bool $is_checked = null,
        public readonly ?int $value = null,
        public readonly ?string $type = null,
    ) {}
}
