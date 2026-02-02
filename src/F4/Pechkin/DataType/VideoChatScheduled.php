<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class VideoChatScheduled extends AbstractDataType
{
    public function __construct(
        public readonly int $start_date,
    ) {}
}
