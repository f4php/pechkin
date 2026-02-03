<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RevenueWithdrawalState,
    TransactionPartner,
};

readonly class TransactionPartnerFragment extends TransactionPartner
{
    public function __construct(
        public readonly ?RevenueWithdrawalState $withdrawal_state = null,
    ) {}
}
