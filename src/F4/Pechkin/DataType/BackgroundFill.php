<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    BackgroundFillFreeformGradient,
    BackgroundFillGradient,
    BackgroundFillSolid,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'freeform_gradient' => BackgroundFillFreeformGradient::class,
    'gradient' => BackgroundFillGradient::class,
    'solid' => BackgroundFillSolid::class,
])]
abstract readonly class BackgroundFill extends AbstractDataType
{
    public readonly string $type;
}
