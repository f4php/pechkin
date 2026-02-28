<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    SharedUser,
    Attribute\ArrayOf,
};

readonly class UsersShared extends AbstractDataType
{
    public function __construct(
        public readonly int $request_id,
        /** @var SharedUser[] */
        #[ArrayOf(SharedUser::class)]
        public readonly array $users,
        public readonly ?array $user_ids = null,
    ) {}
}
