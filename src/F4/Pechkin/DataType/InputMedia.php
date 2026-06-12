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

// The map deliberately covers more subtypes than documented for InputMedia itself:
// it also dispatches the InputPollMedia and InputPollOptionMedia union members
// (link, location, sticker, venue), since those unions are typed as InputMedia.
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
