<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    BackgroundType,
    BackgroundTypeChatTheme,
    BackgroundTypeFill,
    BackgroundTypePattern,
    BackgroundTypeWallpaper,
    Attribute\Polymorphic,
};

readonly class ChatBackground extends AbstractDataType
{
    public function __construct(
        #[Polymorphic([
            'chat_theme' => BackgroundTypeChatTheme::class,
            'fill' => BackgroundTypeFill::class,
            'pattern' => BackgroundTypePattern::class,
            'wallpaper' => BackgroundTypeWallpaper::class,
        ])]
       public readonly BackgroundType $type,
    ) {}
}
