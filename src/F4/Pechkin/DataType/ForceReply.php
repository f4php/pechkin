<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class ForceReply extends AbstractDataType
{
    public function __construct(
        public readonly bool $force_reply,
        public readonly ?string $input_field_placeholder = null,
        public readonly ?bool $selective = null,
    ) {}
}
