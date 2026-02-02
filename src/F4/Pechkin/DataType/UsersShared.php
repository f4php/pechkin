<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    SharedUser,
};

readonly class UsersShared extends AbstractDataType
{
    public function __construct(
        public readonly int $request_id,
        /** @var SharedUser[] */
        public readonly array $users,
    ) {}
}
