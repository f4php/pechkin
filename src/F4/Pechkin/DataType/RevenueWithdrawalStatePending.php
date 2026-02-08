<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\RevenueWithdrawalState;

readonly class RevenueWithdrawalStatePending extends RevenueWithdrawalState
{
    public readonly string $type;
    public function __construct(
        // no data in API docs
    ) {
        $this->type = 'pending';
    }
}
