<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
};

readonly class AcceptedGiftTypes extends AbstractDataType
{
    public function __construct(
        public readonly bool $unlimited_gifts,
        public readonly bool $limited_gifts,
        public readonly bool $unique_gifts,
        public readonly bool $premium_subscription,
        public readonly bool $gifts_from_channels,
    ) {}
}
