<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Gift,
};

readonly class Gifts extends AbstractDataType
{
    public function __construct(
        /** @var Gift[] */
        public readonly array $gifts,
    ) {}
}
