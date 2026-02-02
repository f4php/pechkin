<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ShippingAddress,
    User,
};

readonly class ShippingQuery extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly User $from,
        public readonly string $invoice_payload,
        public readonly ShippingAddress $shipping_address,
    ) {}
}
