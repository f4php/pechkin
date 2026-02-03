<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    TransactionPartner,
    User,
};

readonly class TransactionPartnerAffiliateProgram extends TransactionPartner
{
    public function __construct(
        public readonly int $commission_per_mille,
        public readonly ?User $sponsor_user = null,
    ) {}
}
