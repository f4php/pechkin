<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class MessageId extends AbstractDataType
{
    public function __construct(
        public readonly int $message_id, // may be 0 for scheduled messages
    )
    {}
}
