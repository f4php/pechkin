<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
};

readonly class Story extends AbstractDataType
{
    public function __construct(
        public readonly Chat $chat,
        public readonly int $id,
    ) {}
}
