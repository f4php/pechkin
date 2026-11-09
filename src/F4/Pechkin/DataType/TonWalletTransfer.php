<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class TonWalletTransfer extends AbstractDataType
{
    public function __construct(
        public readonly string $transaction_id,
        public readonly string $peer_address,
        public readonly string $amount, // signed decimal number as a string; may not fit in a 64-bit integer
        public readonly ?string $comment = null,
    ) {}
}
