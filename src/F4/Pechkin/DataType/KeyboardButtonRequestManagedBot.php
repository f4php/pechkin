<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class KeyboardButtonRequestManagedBot extends AbstractDataType
{
    public function __construct(
        public readonly int $request_id,
        public readonly ?string $suggested_name = null,
        public readonly ?string $suggested_username = null,
    ) {}
}
