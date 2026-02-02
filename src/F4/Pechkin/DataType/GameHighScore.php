<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
};

readonly class GameHighScore extends AbstractDataType
{
    public function __construct(
        public readonly int $position,
        public readonly User $user,
        public readonly int $score,
    ) {}
}
