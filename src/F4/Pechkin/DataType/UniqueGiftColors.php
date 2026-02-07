<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Attribute\ArrayOf,
};

readonly class UniqueGiftColors extends AbstractDataType
{
    public function __construct(
        public readonly int $model_custom_emoji_id,
        public readonly string $symbol_custom_emoji_id,
        public readonly int $light_theme_main_color,
        #[ArrayOf('integer')]
        public readonly array $light_theme_other_colors,
        public readonly int $dark_theme_main_color,
        #[ArrayOf('integer')]
        public readonly array $dark_theme_other_colors,
    ) {}
}
