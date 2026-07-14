<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class Community extends AbstractDataType
{
    public function __construct(
        public readonly string $id, // may not fit in a 32-bit integer
        public readonly string $name,
    ) {}
}
