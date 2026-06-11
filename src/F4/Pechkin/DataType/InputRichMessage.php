<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InlineKeyboardMarkup,
    RichBlock,
    Attribute\ArrayOf,
};

readonly class InputRichMessage extends AbstractDataType
{
    public function __construct(
        public readonly ?string $html,
        public readonly ?string $markdown,
        public readonly ?bool $is_rtl,
        public readonly ?bool $skip_entity_detection,
    ) {}
}
