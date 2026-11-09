<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    AreaPosition,
    StoryAreaType,
};

readonly class StoryArea extends AbstractDataType
{
    public function __construct(
        public readonly AreaPosition $position,
        public readonly StoryAreaType $type,
    ) {}
}
