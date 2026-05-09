<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMedia,
    InputMediaAnimation,
    // InputMediaAudio,
    // InputMediaDocument,
    InputMediaLocation,
    InputMediaPhoto,
    InputMediaSticker,
    InputMediaVenue,
    InputMediaVideo,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'animation' => InputMediaAnimation::class,
    // 'audio' => InputMediaAudio::class,
    // 'document' => InputMediaDocument::class,
    'live_photo' => InputMediaLivePhoto::class,
    'location' => InputMediaLocation::class,
    'photo' => InputMediaPhoto::class,
    'sticker' => InputMediaSticker::class,
    'venue' => InputMediaVenue::class,
    'video' => InputMediaVideo::class,
])]
abstract readonly class InputPollOptionMedia extends InputMedia
{
    public readonly string $type;
}
