<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultCachedVideo;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultCachedVideoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_video_full.json');
        $inlineQueryResultCachedVideo = InlineQueryResultCachedVideo::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedVideo::class, $inlineQueryResultCachedVideo);
        $this->assertNotEmpty($inlineQueryResultCachedVideo->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultCachedVideo->reply_markup);
        $this->assertNotNull($inlineQueryResultCachedVideo->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultCachedVideo->id);
        $this->assertSame('test_string', $inlineQueryResultCachedVideo->video_file_id);
        $this->assertSame('Test Title', $inlineQueryResultCachedVideo->title);
        $this->assertSame('Test description', $inlineQueryResultCachedVideo->description);
        $this->assertSame('Test caption', $inlineQueryResultCachedVideo->caption);
        $this->assertSame('HTML', $inlineQueryResultCachedVideo->parse_mode);
        $this->assertSame(false, $inlineQueryResultCachedVideo->show_caption_above_media);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultCachedVideo->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_video_minimal.json');
        $inlineQueryResultCachedVideo = InlineQueryResultCachedVideo::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedVideo::class, $inlineQueryResultCachedVideo);
        $this->assertNull($inlineQueryResultCachedVideo->description);
        $this->assertNull($inlineQueryResultCachedVideo->caption);
        $this->assertNull($inlineQueryResultCachedVideo->parse_mode);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_video_minimal.json');
        $inlineQueryResultCachedVideo = InlineQueryResultCachedVideo::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'video'], $inlineQueryResultCachedVideo->toArray());
    }
}
