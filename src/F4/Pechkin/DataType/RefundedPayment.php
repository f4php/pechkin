<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class RefundedPayment extends AbstractDataType
{
    public function __construct(
        public readonly string $currency,
        public readonly int $total_amount,
        public readonly string $invoice_payload,
        public readonly string $telegram_payment_charge_id,
        public readonly ?string $provider_payment_charge_id = null,
    ) {}
}
