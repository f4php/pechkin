<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class Location extends AbstractDataType
{
    public function __construct(
        public readonly float $latitude,
        public readonly float $longitude,
        public readonly ?float $horizontal_accuracy = null,
        public readonly ?int $live_period = null,
        public readonly ?int $heading = null,
        public readonly ?int $proximity_alert_radius = null,
    ) {}
}
