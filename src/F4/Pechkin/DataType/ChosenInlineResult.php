<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Location,
    User,
};

readonly class ChosenInlineResult extends AbstractDataType
{
    public function __construct(
        public readonly string $result_id,
        public readonly User $from,
        public readonly string $query,
        public readonly ?Location $location = null,
        public readonly ?string $inline_message_id = null,
    ) {}
}
