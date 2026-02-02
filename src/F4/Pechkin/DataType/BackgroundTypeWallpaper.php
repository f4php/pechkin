<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BackgroundType,
    Document,
};

readonly class BackgroundTypeWallpaper extends BackgroundType
{
    public function __construct(
        public readonly string $type,
        public readonly Document $document,
        public readonly int $dark_theme_dimming,
        public readonly ?bool $is_blurred = null,
        public readonly ?bool $is_moving = null,
    ) {}
}
