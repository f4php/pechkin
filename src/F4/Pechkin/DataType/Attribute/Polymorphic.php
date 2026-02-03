<?php

namespace F4\Pechkin\DataType\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
final readonly class Polymorphic
{
    public function __construct(
        public readonly array $map,
        public readonly string $base = '',
        public readonly string $discriminator = 'type',
    ) {}
}
