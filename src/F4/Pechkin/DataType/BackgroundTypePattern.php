<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BackgroundFill,
    BackgroundType,
    Document,
};

readonly class BackgroundTypePattern extends BackgroundType
{
    public function __construct(
        public readonly string $type,
        public readonly Document $document,
        public readonly BackgroundFill $fill,
        public readonly int $intensity,
        public readonly ?bool $is_inverted = null,
        public readonly ?bool $is_moving = null,
    ) {}
}
