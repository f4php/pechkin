<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\Attribute\ArrayOf;

use F4\Pechkin\DataType\{
    AbstractDataType,
    RichText,
};

readonly class RichBlockTableCell extends AbstractDataType
{
    public function __construct(
        public readonly string $align, // 'left', 'center', 'right'
        public readonly string $valign, // 'top', 'middle', 'bottom'
        /** @var RichText|RichText[]|string|null */
        #[ArrayOf(RichText::class)]
        public readonly RichText|array|string|null $text = null,
        public readonly ?bool $is_header = null,
        public readonly ?int $colspan = null,
        public readonly ?int $rowspan = null,
    ) {}
}
