<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    MessageOrigin,
    User,
};

readonly class MessageOriginUser extends MessageOrigin
{
    public readonly string $type;
    public function __construct(
        public readonly int $date,
        public readonly User $sender_user,
    ) {
        $this->type = 'user';
    }
}
