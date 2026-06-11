<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputRichMessage,
};

readonly class InputRichMessageContent extends AbstractDataType
{
    public function __construct(
        public readonly InputRichMessage $rich_message,
    ) {}
}
