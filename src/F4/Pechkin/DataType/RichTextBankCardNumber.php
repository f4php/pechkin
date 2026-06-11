<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichText,
};

readonly class RichTextBankCardNumber extends RichText
{
    public readonly string $type;
    public function __construct(
        public readonly RichText $text,
        public readonly string $bank_card_number,
    ) {
        $this->type = 'bank_card_number';
    }
}
