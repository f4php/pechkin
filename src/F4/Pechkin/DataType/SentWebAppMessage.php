<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class SentWebAppMessage extends AbstractDataType
{
    public function __construct(
        public readonly ?string $inline_message_id = null,
    ) {}
}
