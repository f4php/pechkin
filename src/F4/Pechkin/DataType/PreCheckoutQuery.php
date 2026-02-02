<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    OrderInfo,
    User,
};

readonly class PreCheckoutQuery extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly User $from,
        public readonly string $currency,
        public readonly int $total_amount,
        public readonly string $invoice_payload,
        public readonly ?string $shipping_option_id = null,
        public readonly ?OrderInfo $order_info = null,
    ) {}
}
