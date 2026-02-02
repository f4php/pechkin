<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class UserRating extends AbstractDataType
{
    public function __construct(
        public readonly int $level,
        public readonly int $rating,
        public readonly int $current_level_rating,
        public readonly ?int $next_level_rating = null,
    ) {}
}
