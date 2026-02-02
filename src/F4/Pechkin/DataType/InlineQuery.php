<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Location,
    User,
};

readonly class InlineQuery extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly User $from,
        public readonly string $query,
        public readonly string $offset,
        public readonly ?string $chat_type = null,
        public readonly ?Location $location = null,
    ) {}
}
