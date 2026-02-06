<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ChatBoostSource,
};

readonly class ChatBoost extends AbstractDataType
{
    public function __construct(
        public readonly string $boost_id,
        public readonly int $add_date,
        public readonly int $expiration_date,
        public readonly ChatBoostSource $source,
    ) {}
}
