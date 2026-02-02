<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class DirectMessagePriceChanged extends AbstractDataType
{
    public function __construct(
        public readonly bool $are_direct_messages_enabled,
        public readonly ?int $direct_message_star_count = null,
    ) {}
}
