<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class Invoice extends AbstractDataType
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly string $start_parameter,
        public readonly string $currency,
        public readonly int $total_amount,
    ) {}
}
