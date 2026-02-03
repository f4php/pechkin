<?php

namespace F4\Pechkin\DataType\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
final readonly class ArrayOf
{
    public function __construct(
        public readonly string|Attribute $type,
    ) {}
}
