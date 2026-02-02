<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class MessageAutoDeleteTimerChanged extends AbstractDataType
{
    public function __construct(
        public readonly int $message_auto_delete_time,
    ) {}
}
