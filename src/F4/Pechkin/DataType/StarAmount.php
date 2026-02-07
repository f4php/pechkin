<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class StarAmount extends AbstractDataType
{
    public function __construct(
        public readonly int $amount,
        public readonly ?int $nanostar_amount = null,
    ) {}
}
