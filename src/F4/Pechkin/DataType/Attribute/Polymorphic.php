<?php

namespace F4\Pechkin\DataType\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_PROPERTY)]
final readonly class Polymorphic
{
    public function __construct(
        public readonly array $map,
        public readonly string $discriminator = 'type',
    ) {}
}
