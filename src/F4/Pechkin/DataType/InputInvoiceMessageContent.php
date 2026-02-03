<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMessageContent,
    LabeledPrice,
    Attribute\ArrayOf,
};

readonly class InputInvoiceMessageContent extends InputMessageContent
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly string $payload,
        public readonly string $currency,
        /** @var LabeledPrice[] */
        #[ArrayOf(LabeledPrice::class)]
        public readonly array $prices,
        public readonly ?string $provider_token = null,
        public readonly ?int $max_tip_amount = null,
        /** @var int[]|null */
        #[ArrayOf('int')]
        public readonly ?array $suggested_tip_amounts = null,
        public readonly ?string $provider_data = null,
        public readonly ?string $photo_url = null,
        public readonly ?int $photo_size = null,
        public readonly ?int $photo_width = null,
        public readonly ?int $photo_height = null,
        public readonly ?bool $need_name = null,
        public readonly ?bool $need_phone_number = null,
        public readonly ?bool $need_email = null,
        public readonly ?bool $need_shipping_address = null,
        public readonly ?bool $send_phone_number_to_provider = null,
        public readonly ?bool $send_email_to_provider = null,
        public readonly ?bool $is_flexible = null,
    ) {}
}
