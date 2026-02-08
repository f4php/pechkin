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
    public readonly string $type;
    public function __construct(
        public readonly Chat $chat,
        public readonly ?Gift $gift = null,
    ) {
        $this->type = 'chat';
    }
}
