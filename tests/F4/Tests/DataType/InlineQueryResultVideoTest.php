<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultVideo;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultVideoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_video_full.json');
        $inlineQueryResultVideo = InlineQueryResultVideo::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultVideo::class, $inlineQueryResultVideo);
        $this->assertNotEmpty($inlineQueryResultVideo->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultVideo->reply_markup);
        $this->assertNotNull($inlineQueryResultVideo->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultVideo->id);
        $this->assertSame('https://example.com/video.mp4', $inlineQueryResultVideo->video_url);
        $this->assertSame('application/pdf', $inlineQueryResultVideo->mime_type);
        $this->assertSame('https://example.com/thumb.jpg', $inlineQueryResultVideo->thumbnail_url);
        $this->assertSame('Test Title', $inlineQueryResultVideo->title);
        $this->assertSame('Test caption', $inlineQueryResultVideo->caption);
        $this->assertSame('HTML', $inlineQueryResultVideo->parse_mode);
        $this->assertSame(false, $inlineQueryResultVideo->show_caption_above_media);
        $this->assertSame(1280, $inlineQueryResultVideo->video_width);
        $this->assertSame(720, $inlineQueryResultVideo->video_height);
        $this->assertSame(60, $inlineQueryResultVideo->video_duration);
        $this->assertSame('Test description', $inlineQueryResultVideo->description);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultVideo->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_video_minimal.json');
        $inlineQueryResultVideo = InlineQueryResultVideo::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultVideo::class, $inlineQueryResultVideo);
        $this->assertNull($inlineQueryResultVideo->caption);
        $this->assertNull($inlineQueryResultVideo->parse_mode);
        $this->assertNull($inlineQueryResultVideo->caption_entities);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_video_minimal.json');
        $inlineQueryResultVideo = InlineQueryResultVideo::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'video'], $inlineQueryResultVideo->toArray());
    }
}
