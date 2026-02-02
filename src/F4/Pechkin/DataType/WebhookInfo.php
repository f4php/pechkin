<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class WebhookInfo extends AbstractDataType
{
    public function __construct(
        public readonly string $url,
        public readonly bool $has_custom_certificate,
        public readonly int $pending_update_count,
        public readonly ?string $ip_address = null,
        public readonly ?int $last_error_date = null,
        public readonly ?string $last_error_message = null,
        public readonly ?int $last_synchronization_error_date = null,
        public readonly ?int $max_connections = null,
        /** @var string[]|null */
        public readonly ?array $allowed_updates = null,
    ) {}
}
