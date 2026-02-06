<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InlineQueryResultArticle,
    InlineQueryResultAudio,
    InlineQueryResultCachedAudio,
    InlineQueryResultCachedDocument,
    InlineQueryResultCachedGif,
    InlineQueryResultCachedMpeg4Gif,
    InlineQueryResultCachedPhoto,
    InlineQueryResultCachedSticker,
    InlineQueryResultCachedVideo,
    InlineQueryResultCachedVoice,
    InlineQueryResultContact,
    InlineQueryResultDocument,
    InlineQueryResultGame,
    InlineQueryResultGif,
    InlineQueryResultLocation,
    InlineQueryResultMpeg4Gif,
    InlineQueryResultPhoto,
    InlineQueryResultVenue,
    InlineQueryResultVideo,
    InlineQueryResultVoice,
    Attribute\Polymorphic,
};

#[Polymorphic([

    // InlineQueryResultCachedAudio::class,
    // InlineQueryResultCachedDocument::class,
    // InlineQueryResultCachedGif::class,
    // InlineQueryResultCachedMpeg4Gif::class,
    // InlineQueryResultCachedPhoto::class,
    // InlineQueryResultCachedSticker::class,
    // InlineQueryResultCachedVideo::class,
    // InlineQueryResultCachedVoice::class,
    // InlineQueryResultArticle::class,
    // InlineQueryResultAudio::class,
    // InlineQueryResultContact::class,
    // InlineQueryResultGame::class,
    // InlineQueryResultDocument::class,
    // InlineQueryResultGif::class,
    // InlineQueryResultLocation::class,
    // InlineQueryResultMpeg4Gif::class,
    // InlineQueryResultPhoto::class,
    // InlineQueryResultVenue::class,
    // InlineQueryResultVideo::class,
    // InlineQueryResultVoice::class,

])]
abstract readonly class InlineQueryResult extends AbstractDataType
{
}
