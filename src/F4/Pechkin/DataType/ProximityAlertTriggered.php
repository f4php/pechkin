<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
};

readonly class ProximityAlertTriggered extends AbstractDataType
{
    public function __construct(
        public readonly User $traveler,
        public readonly User $watcher,
        public readonly int $distance,
    ) {}
}
