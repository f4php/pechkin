<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class ResponseParameters extends AbstractDataType
{
    public function __construct(
        public readonly ?string $migrate_to_chat_id = null, // may not fit in a 32-bit integer
        public readonly ?int $retry_after = null,
    ) {}
}
