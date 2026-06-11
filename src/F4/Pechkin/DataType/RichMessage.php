<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    RichBlock,
    Attribute\ArrayOf,
};

readonly class RichMessage extends AbstractDataType
{
    public function __construct(
        /** @var RichBlock[] */
        #[ArrayOf(RichBlock::class)]
        public readonly array $blocks,
        public readonly ?bool $is_rtl = null,
    ) {}
}
