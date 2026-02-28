<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
};

// This data type is not documented, but sent by the API during contact sharing
readonly class UserShared extends AbstractDataType
{
    public function __construct(
        public readonly int $request_id,
        public readonly int|string $user_id,
    ) {}
}
