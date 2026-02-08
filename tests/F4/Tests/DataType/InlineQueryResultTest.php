<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\InlineQueryResult;
use F4\Pechkin\DataType\InlineQueryResultArticle;
use F4\Pechkin\DataType\InlineQueryResultPhoto;
use F4\Pechkin\DataType\InlineQueryResultGif;
use F4\Pechkin\DataType\InlineQueryResultMpeg4Gif;
use F4\Pechkin\DataType\InlineQueryResultVideo;
use F4\Pechkin\DataType\InlineQueryResultAudio;
use F4\Pechkin\DataType\InlineQueryResultVoice;
use F4\Pechkin\DataType\InlineQueryResultDocument;
use F4\Pechkin\DataType\InlineQueryResultLocation;
use F4\Pechkin\DataType\InlineQueryResultVenue;
use F4\Pechkin\DataType\InlineQueryResultContact;
use F4\Pechkin\DataType\InlineQueryResultGame;
use F4\Pechkin\DataType\InlineQueryResultCachedPhoto;
use F4\Pechkin\DataType\InlineQueryResultCachedGif;
use F4\Pechkin\DataType\InlineQueryResultCachedMpeg4Gif;
use F4\Pechkin\DataType\InlineQueryResultCachedSticker;
use F4\Pechkin\DataType\InlineQueryResultCachedDocument;
use F4\Pechkin\DataType\InlineQueryResultCachedVideo;
use F4\Pechkin\DataType\InlineQueryResultCachedVoice;
use F4\Pechkin\DataType\InlineQueryResultCachedAudio;

final class InlineQueryResultTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithArticleType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_article_full.json'),
            'type' => 'article',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultArticle::class, $result);
    }

    public function testFromArrayWithPhotoType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_photo_full.json'),
            'type' => 'photo',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultPhoto::class, $result);
    }

    public function testFromArrayWithGifType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_gif_full.json'),
            'type' => 'gif',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultGif::class, $result);
    }

    public function testFromArrayWithMpeg4GifType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_mpeg4_gif_full.json'),
            'type' => 'mpeg4_gif',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultMpeg4Gif::class, $result);
    }

    public function testFromArrayWithVideoType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_video_full.json'),
            'type' => 'video',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultVideo::class, $result);
    }

    public function testFromArrayWithAudioType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_audio_full.json'),
            'type' => 'audio',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultAudio::class, $result);
    }

    public function testFromArrayWithVoiceType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_voice_full.json'),
            'type' => 'voice',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultVoice::class, $result);
    }

    public function testFromArrayWithDocumentType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_document_full.json'),
            'type' => 'document',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultDocument::class, $result);
    }

    public function testFromArrayWithLocationType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_location_full.json'),
            'type' => 'location',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultLocation::class, $result);
    }

    public function testFromArrayWithVenueType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_venue_full.json'),
            'type' => 'venue',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultVenue::class, $result);
    }

    public function testFromArrayWithContactType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_contact_full.json'),
            'type' => 'contact',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultContact::class, $result);
    }

    public function testFromArrayWithGameType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_game_full.json'),
            'type' => 'game',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultGame::class, $result);
    }

    public function testFromArrayWithCachedPhotoType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_cached_photo_full.json'),
            'type' => 'photo',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultCachedPhoto::class, $result);
    }

    public function testFromArrayWithCachedStickerType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_cached_sticker_full.json'),
            'type' => 'sticker',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultCachedSticker::class, $result);
    }

    public function testFromArrayWithCachedGifType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_cached_gif_full.json'),
            'type' => 'gif',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultCachedGif::class, $result);
    }

    public function testFromArrayWithCachedMpeg4GifType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_cached_mpeg4_gif_full.json'),
            'type' => 'mpeg4_gif',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultCachedMpeg4Gif::class, $result);
    }

    public function testFromArrayWithCachedDocumentType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_cached_document_full.json'),
            'type' => 'document',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultCachedDocument::class, $result);
    }

    public function testFromArrayWithCachedVideoType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_cached_video_full.json'),
            'type' => 'video',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultCachedVideo::class, $result);
    }

    public function testFromArrayWithCachedVoiceType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_cached_voice_full.json'),
            'type' => 'voice',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultCachedVoice::class, $result);
    }

    public function testFromArrayWithCachedAudioType(): void
    {
        $data = [
            ...$this->loadFixture('inline_query_result_cached_audio_full.json'),
            'type' => 'audio',
        ];
        $result = InlineQueryResult::fromArray($data);
        $this->assertInstanceOf(InlineQueryResultCachedAudio::class, $result);
    }
}
