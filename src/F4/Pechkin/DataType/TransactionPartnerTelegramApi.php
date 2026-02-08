<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\TransactionPartner;

readonly class TransactionPartnerTelegramApi extends TransactionPartner
{
    public readonly string $type;
    public function __construct(
        public readonly int $request_count,
    ) {
        $this->type = 'telegram_api';
    }
}
