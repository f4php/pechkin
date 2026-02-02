<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InlineKeyboardButton,
};

readonly class InlineKeyboardMarkup extends AbstractDataType
{
    public function __construct(
        /** @var InlineKeyboardButton[][] */
        public readonly array $inline_keyboard,
    ) {}
}
