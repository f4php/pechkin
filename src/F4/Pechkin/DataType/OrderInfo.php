<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ShippingAddress,
};

readonly class OrderInfo extends AbstractDataType
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $phone_number = null,
        public readonly ?string $email = null,
        public readonly ?ShippingAddress $shipping_address = null,
    ) {}
}
