<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class WidgetQueryWallet extends AbstractDataType
{
    public function __construct(
        public readonly string $address,
        public readonly string $amount,
        public readonly ?string $public_key = null,
        public readonly ?string $state_init = null,
    ) {}
}
