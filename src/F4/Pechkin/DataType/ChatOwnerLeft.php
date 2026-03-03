<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
};

readonly class ChatOwnerLeft extends AbstractDataType
{
    public function __construct(
        public readonly ?User $new_owner = null,
    ) {}
}
