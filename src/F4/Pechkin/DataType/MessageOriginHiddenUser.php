<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\MessageOrigin;

readonly class MessageOriginHiddenUser extends MessageOrigin
{
    public function __construct(
        public readonly int $date,
        public readonly string $sender_user_name,
    ) {}
}
