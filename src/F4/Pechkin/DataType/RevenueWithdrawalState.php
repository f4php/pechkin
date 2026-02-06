<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    RevenueWithdrawalStatePending,
    RevenueWithdrawalStateSucceeded,
    RevenueWithdrawalStateFailed,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'pending' => RevenueWithdrawalStatePending::class,
    'succeeded' => RevenueWithdrawalStateSucceeded::class,
    'failed' => RevenueWithdrawalStateFailed::class,
])]
abstract readonly class RevenueWithdrawalState extends AbstractDataType
{
}
