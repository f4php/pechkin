<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
};

readonly class BotSubscriptionUpdated extends AbstractDataType
{
    public function __construct(
        public readonly User $user,
        public readonly string $invoice_payload,
        public readonly string $state,
    ) {}
}
