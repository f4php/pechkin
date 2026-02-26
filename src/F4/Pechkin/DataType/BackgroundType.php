<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    BackgroundTypeFill,
    BackgroundTypeWallpaper,
    BackgroundTypePattern,
    BackgroundTypeChatTheme,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'chat_theme' => BackgroundTypeChatTheme::class,
    'fill' => BackgroundTypeFill::class,
    'pattern' => BackgroundTypePattern::class,
    'wallpaper' => BackgroundTypeWallpaper::class,
])]
abstract readonly class BackgroundType extends AbstractDataType
{
    public readonly string $type;
}
