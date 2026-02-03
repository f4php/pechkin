<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BackgroundFill,
    BackgroundFillFreeformGradient,
    BackgroundFillGradient,
    BackgroundFillSolid,
    BackgroundType,
    Document,
    Attribute\Polymorphic,
};

readonly class BackgroundTypePattern extends BackgroundType
{
    public function __construct(
        public readonly Document $document,
        #[Polymorphic([
            'freeform_gradient' => BackgroundFillFreeformGradient::class,
            'gradient' => BackgroundFillGradient::class,
            'solid' => BackgroundFillSolid::class,
        ])]
        public readonly BackgroundFill $fill,
        public readonly int $intensity,
        public readonly ?bool $is_inverted = null,
        public readonly ?bool $is_moving = null,
    ) {}
}
