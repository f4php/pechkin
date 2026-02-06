<?php

namespace F4\Pechkin\DataType\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
final readonly class OneOf
{
    public array $values;
    public function __construct(
        ...$values,
    ) {
        $this->values = $values;
    }
}
