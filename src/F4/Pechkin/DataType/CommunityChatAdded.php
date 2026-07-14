<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Community,
};

readonly class CommunityChatAdded extends AbstractDataType
{
    public function __construct(
        public readonly Community $community,
    ) {}
}
