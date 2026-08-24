<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class EphemeralMessageParameters extends AbstractDataType
{
    public function __construct(
        public readonly string $receiver_user_id, // may not fit in a 32-bit integer
        public readonly ?string $callback_query_id = null,
        public readonly ?bool $replace_callback_query_message = null,
    ) {}
}
