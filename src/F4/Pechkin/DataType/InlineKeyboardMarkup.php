<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InlineKeyboardButton,
    Attribute\ArrayOf,
};

readonly class InlineKeyboardMarkup extends AbstractDataType
{
    public function __construct(
        /** @var InlineKeyboardButton[][] */
        #[ArrayOf(new ArrayOf(InlineKeyboardButton::class))]
        public readonly array $inline_keyboard,
    ) {}
}
