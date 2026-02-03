<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    Chat,
    Gift,
    TransactionPartner,
};

readonly class TransactionPartnerChat extends TransactionPartner
{
    public function __construct(
        public readonly Chat $chat,
        public readonly ?Gift $gift = null,
    ) {}
}
