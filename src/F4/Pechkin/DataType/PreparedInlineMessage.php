<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class PreparedInlineMessage extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly int $expiration_date,
    ) {}
}
