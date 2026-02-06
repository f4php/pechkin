<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    StoryAreaPosition,
    StoryAreaType,
};

readonly class StoryArea extends AbstractDataType
{
    public function __construct(
        public readonly StoryAreaPosition $position,
        public readonly StoryAreaType $type,
    ) {}
}
