<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    OwnedGiftRegular,
    OwnedGiftUnique,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'regular' => OwnedGiftRegular::class,
    'unique' => OwnedGiftUnique::class,
])]
abstract readonly class OwnedGift extends AbstractDataType
{
    public readonly string $type;
}
