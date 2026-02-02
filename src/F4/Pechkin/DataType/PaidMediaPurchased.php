<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
};

readonly class PaidMediaPurchased extends AbstractDataType
{
    public function __construct(
        public readonly User $from,
        public readonly string $paid_media_payload,
    ) {}
}
