<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class UniqueGiftBackdropColors extends AbstractDataType
{
    public function __construct(
        public readonly int $primary_color,
        public readonly int $peach_color,
        public readonly int $background_color,
        public readonly int $text_color,
        public readonly int $accent_color,
    ) {}
}
