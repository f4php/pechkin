<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ReactionType,
};

readonly class ReactionCount extends AbstractDataType
{
    public function __construct(
        public readonly ReactionType $type,
        public readonly int $total_count,
    ) {}
}
