<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\ReactionType;

readonly class ReactionTypePaid extends ReactionType
{
    public function __construct(
        public readonly string $type,
    ) {}
}
