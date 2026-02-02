<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    KeyboardButton,
};

readonly class ReplyKeyboardMarkup extends AbstractDataType
{
    public function __construct(
        /** @var KeyboardButton[][] */
        public readonly array $keyboard,
        public readonly ?bool $is_persistent = null,
        public readonly ?bool $resize_keyboard = null,
        public readonly ?bool $one_time_keyboard = null,
        public readonly ?string $input_field_placeholder = null,
        public readonly ?bool $selective = null,
    ) {}
}
