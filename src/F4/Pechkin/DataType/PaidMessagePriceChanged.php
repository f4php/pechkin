<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class PaidMessagePriceChanged extends AbstractDataType
{
    public function __construct(
        public readonly int $paid_message_star_count,
    ) {}
}
