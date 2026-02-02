<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    BusinessOpeningHoursInterval,
};

readonly class BusinessOpeningHours extends AbstractDataType
{
    public function __construct(
        public readonly string $time_zone_name,
        /** @var BusinessOpeningHoursInterval[] */
        public readonly array $opening_hours,
    ) {}
}
