<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    ChatBoostSource,
};

readonly class ChatBoostRemoved extends AbstractDataType
{
    public function __construct(
        public readonly Chat $chat,
        public readonly string $boost_id,
        public readonly int $remove_date,
        public readonly ChatBoostSource $source,
    ) {}
}
