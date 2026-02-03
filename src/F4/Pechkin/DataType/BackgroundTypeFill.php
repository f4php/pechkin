<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BackgroundFill,
    BackgroundFillFreeformGradient,
    BackgroundFillGradient,
    BackgroundFillSolid,
    BackgroundType,
    Attribute\Polymorphic,
};

readonly class BackgroundTypeFill extends BackgroundType
{
    public function __construct(
        #[Polymorphic([
            'freeform_gradient' => BackgroundFillFreeformGradient::class,
            'gradient' => BackgroundFillGradient::class,
            'solid' => BackgroundFillSolid::class,
        ])]
        public readonly BackgroundFill $fill,
        public readonly int $dark_theme_dimming,
    ) {}
}
