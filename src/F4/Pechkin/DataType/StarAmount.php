<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class StarAmount extends AbstractDataType
{
    public function __construct(
        public readonly int $total_count,
        public readonly ?int $purchased_count = null,
        public readonly ?int $granted_count = null,
    ) {}
}
