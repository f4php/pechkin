<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    RichBlock,
    Attribute\ArrayOf,
};

readonly class RichBlockListItem extends AbstractDataType
{
    public function __construct(
        public readonly string $label,
        /** @var RichBlock[] */
        #[ArrayOf(RichBlock::class)]
        public readonly array $blocks,
        public readonly ?bool $has_checkbox = null,
        public readonly ?bool $is_checked = null,
        public readonly ?int $value = null,
        public readonly ?string $type = null,
    ) {}
}
