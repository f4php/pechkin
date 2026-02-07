<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    OrderInfo,
};

readonly class SuccessfulPayment extends AbstractDataType
{
    public function __construct(
        public readonly string $currency,
        public readonly int $total_amount,
        public readonly string $invoice_payload,
        public readonly string $telegram_payment_charge_id,
        public readonly string $provider_payment_charge_id,
        public readonly ?int $subscription_expiration_date = null,
        public readonly ?bool $is_recurring = null,
        public readonly ?bool $is_first_recurring = null,
        public readonly ?string $shipping_option_id = null,
        public readonly ?OrderInfo $order_info = null,
    ) {}
}
