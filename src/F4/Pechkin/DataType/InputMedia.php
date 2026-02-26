<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputMediaAnimation,
    InputMediaAudio,
    InputMediaDocument,
    InputMediaPhoto,
    InputMediaVideo,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'animation' => InputMediaAnimation::class,
    'document' => InputMediaDocument::class,
    'audio' => InputMediaAudio::class,
    'photo' => InputMediaPhoto::class,
    'video' => InputMediaVideo::class,
])]
abstract readonly class InputMedia extends AbstractDataType
{
    public readonly string $type;
}
