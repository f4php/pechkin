<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class Birthdate extends AbstractDataType
{
    public function __construct(
        public readonly int $day,
        public readonly int $month,
        public readonly ?int $year = null,
    ) {}
}
