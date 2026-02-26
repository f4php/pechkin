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
    'article' => InlineQueryResultArticle::class,
    'audio' => new Polymorphic(
        createFromArray: static function ($data) {
            return match(true) {
                isset($data['audio_url']) => InlineQueryResultAudio::fromArray($data),
                isset($data['audio_file_id']) => InlineQueryResultCachedAudio::fromArray($data),
                default => null,
            };
        }
    ),
    'contact' => InlineQueryResultContact::class,
    'game' => InlineQueryResultGame::class,
    'document' => new Polymorphic(
        createFromArray: static function ($data) {
            return match(true) {
                isset($data['document_url']) => InlineQueryResultDocument::fromArray($data),
                isset($data['document_file_id']) => InlineQueryResultCachedDocument::fromArray($data),
                default => null,
            };
        }
    ),
    'gif' => new Polymorphic(
        createFromArray: static function ($data) {
            return match(true) {
                isset($data['gif_url']) => InlineQueryResultGif::fromArray($data),
                isset($data['gif_file_id']) => InlineQueryResultCachedGif::fromArray($data),
                default => null,
            };
        }
    ),
    'location' => InlineQueryResultLocation::class,
    'mpeg4_gif' => new Polymorphic(
        createFromArray: static function ($data) {
            return match(true) {
                isset($data['mpeg4_url']) => InlineQueryResultMpeg4Gif::fromArray($data),
                isset($data['mpeg4_file_id']) => InlineQueryResultCachedMpeg4Gif::fromArray($data),
                default => null,
            };
        }
    ),
    'photo' => new Polymorphic(
        createFromArray: static function ($data) {
            return match(true) {
                isset($data['photo_url']) => InlineQueryResultPhoto::fromArray($data),
                isset($data['photo_file_id']) => InlineQueryResultCachedPhoto::fromArray($data),
                default => null,
            };
        }
    ),
    'sticker' => InlineQueryResultCachedSticker::class,
    'venue' => InlineQueryResultVenue::class,
    'video' => new Polymorphic(
        createFromArray: static function ($data) {
            return match(true) {
                isset($data['video_url']) => InlineQueryResultVideo::fromArray($data),
                isset($data['video_file_id']) => InlineQueryResultCachedVideo::fromArray($data),
                default => null,
            };
        }
    ),
    'voice' => new Polymorphic(
        createFromArray: static function ($data) {
            return match(true) {
                isset($data['voice_url']) => InlineQueryResultVoice::fromArray($data),
                isset($data['voice_file_id']) => InlineQueryResultCachedVoice::fromArray($data),
                default => null,
            };
        }
    ),
])]
abstract readonly class InlineQueryResult extends AbstractDataType
{
    public readonly string $type;
}
