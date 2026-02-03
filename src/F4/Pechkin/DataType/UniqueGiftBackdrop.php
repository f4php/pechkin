<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    BackgroundFill,
    BackgroundFillFreeformGradient,
    BackgroundFillGradient,
    BackgroundFillSolid,
    Attribute\Polymorphic,
};

readonly class UniqueGiftBackdrop extends AbstractDataType
{
    public function __construct(
        #[Polymorphic([
            'freeform_gradient' => BackgroundFillFreeformGradient::class,
            'gradient' => BackgroundFillGradient::class,
            'solid' => BackgroundFillSolid::class,
        ])]
        public readonly BackgroundFill $fill,
    ) {}
}
