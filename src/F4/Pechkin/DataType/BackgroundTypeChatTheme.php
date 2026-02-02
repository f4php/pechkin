<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BackgroundType,
};

readonly class BackgroundTypeChatTheme extends BackgroundType
{
    public function __construct(
        public readonly string $type,
        public readonly string $theme_name,
    ) {}
}
