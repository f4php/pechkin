<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    StarAmount,
};

readonly class SuggestedPostPrice extends AbstractDataType
{
    public function __construct(
        public readonly string $currency,
        public readonly int $amount,
    ) {}
}
