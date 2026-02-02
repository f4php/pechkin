<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    WebAppInfo,
};

readonly class InlineQueryResultsButton extends AbstractDataType
{
    public function __construct(
        public readonly string $text,
        public readonly ?WebAppInfo $web_app = null,
        public readonly ?string $start_parameter = null,
    ) {}
}
