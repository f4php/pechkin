<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\RevenueWithdrawalState;

readonly class RevenueWithdrawalStateSucceeded extends RevenueWithdrawalState
{
    public readonly string $type;
    public function __construct(
        public readonly int $date,
        public readonly string $url,
    ) {
        $this->type = 'succeeded';
    }
}
