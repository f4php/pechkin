<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
};

readonly class DirectMessagesTopic extends AbstractDataType
{
    public function __construct(
        public readonly string $topic_id, // may not fit in a 32-bit integer
        public readonly User $user,
    ) {}
}
