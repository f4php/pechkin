<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class AcceptedGiftTypes extends AbstractDataType
{
    public function __construct(
        public readonly ?bool $gifts_from_channels = null,
    ) {}
}
