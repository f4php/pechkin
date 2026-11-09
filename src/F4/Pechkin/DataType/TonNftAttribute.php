<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class TonNftAttribute extends AbstractDataType
{
    public function __construct(
        public readonly string $trait_type,
        public readonly string $value,
    ) {}
}
