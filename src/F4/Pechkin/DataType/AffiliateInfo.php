<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    User,
};

readonly class AffiliateInfo extends AbstractDataType
{
    public function __construct(
        public readonly int $commission_per_mille,
        public readonly int $amount,
        public readonly ?User $affiliate_user = null,
        public readonly ?Chat $affiliate_chat = null,
        public readonly ?int $nanostar_amount = null,
    ) {}
}
