<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    RichText,
};

readonly class RichBlockCaption extends AbstractDataType
{
    public function __construct(
        public readonly RichText $text,
        public readonly ?RichText $credit = null,
    ) {}
}
