<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    TransactionPartner,
};

readonly class StarTransaction extends AbstractDataType
{
    public function __construct(
        public readonly string $id, 
        public readonly int $amount,
        public readonly int $date,
        public readonly ?int $nanostar_amount = null,
        public readonly ?TransactionPartner $source = null,
        public readonly ?TransactionPartner $receiver = null,
    ) {}
}
