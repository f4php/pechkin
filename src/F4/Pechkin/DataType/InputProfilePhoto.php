<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputProfilePhotoStatic,
    InputProfilePhotoAnimated,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'static' => InputProfilePhotoStatic::class,
    'animated' => InputProfilePhotoAnimated::class,
])]
abstract readonly class InputProfilePhoto extends AbstractDataType
{
}
