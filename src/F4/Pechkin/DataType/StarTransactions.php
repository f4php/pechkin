<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    StarTransaction,
    Attribute\ArrayOf,
};

readonly class StarTransactions extends AbstractDataType
{
    public function __construct(
        /** @var StarTransaction[]|null */
        #[ArrayOf(StarTransaction::class)]
        public readonly array $transactions,
    ) {}
}
