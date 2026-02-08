<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\ReactionType;

readonly class ReactionTypePaid extends ReactionType
{
    public readonly string $type;
    public function __construct(
        // no data in API docs
    ) {
        $this->type = 'paid';
    }
}
