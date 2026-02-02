<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class ReplyKeyboardRemove extends AbstractDataType
{
    public function __construct(
        public readonly bool $remove_keyboard,
        public readonly ?bool $selective = null,
    ) {}
}
