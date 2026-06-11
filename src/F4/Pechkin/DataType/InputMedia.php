<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputMediaAnimation,
    InputMediaAudio,
    InputMediaDocument,
    InputMediaLink,
    InputMediaLivePhoto,
    InputMediaLocation,
    InputMediaPhoto,
    InputMediaSticker,
    InputMediaVenue,
    InputMediaVideo,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'animation' => InputMediaAnimation::class,
    'audio' => InputMediaAudio::class,
    'document' => InputMediaDocument::class,
    'link' => InputMediaLink::class,
    'live_photo' => InputMediaLivePhoto::class,
    'location' => InputMediaLocation::class,
    'photo' => InputMediaPhoto::class,
    'sticker' => InputMediaSticker::class,
    'venue' => InputMediaVenue::class,
    'video' => InputMediaVideo::class,
])]
abstract readonly class InputMedia extends AbstractDataType
{
    public readonly string $type;
}
