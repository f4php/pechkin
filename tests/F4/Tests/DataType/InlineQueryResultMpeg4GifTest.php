<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultMpeg4Gif;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultMpeg4GifTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_mpeg4_gif_full.json');
        $inlineQueryResultMpeg4Gif = InlineQueryResultMpeg4Gif::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultMpeg4Gif::class, $inlineQueryResultMpeg4Gif);
        $this->assertNotEmpty($inlineQueryResultMpeg4Gif->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultMpeg4Gif->reply_markup);
        $this->assertNotNull($inlineQueryResultMpeg4Gif->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultMpeg4Gif->id);
        $this->assertSame('https://example.com/video.mp4', $inlineQueryResultMpeg4Gif->mpeg4_url);
        $this->assertSame('https://example.com/thumb.jpg', $inlineQueryResultMpeg4Gif->thumbnail_url);
        $this->assertSame(320, $inlineQueryResultMpeg4Gif->mpeg4_width);
        $this->assertSame(240, $inlineQueryResultMpeg4Gif->mpeg4_height);
        $this->assertSame(10, $inlineQueryResultMpeg4Gif->mpeg4_duration);
        $this->assertSame('test_string', $inlineQueryResultMpeg4Gif->thumbnail_mime_type);
        $this->assertSame('Test Title', $inlineQueryResultMpeg4Gif->title);
        $this->assertSame('Test caption', $inlineQueryResultMpeg4Gif->caption);
        $this->assertSame('HTML', $inlineQueryResultMpeg4Gif->parse_mode);
        $this->assertSame(false, $inlineQueryResultMpeg4Gif->show_caption_above_media);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultMpeg4Gif->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_mpeg4_gif_minimal.json');
        $inlineQueryResultMpeg4Gif = InlineQueryResultMpeg4Gif::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultMpeg4Gif::class, $inlineQueryResultMpeg4Gif);
        $this->assertNull($inlineQueryResultMpeg4Gif->mpeg4_width);
        $this->assertNull($inlineQueryResultMpeg4Gif->mpeg4_height);
        $this->assertNull($inlineQueryResultMpeg4Gif->mpeg4_duration);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_mpeg4_gif_minimal.json');
        $inlineQueryResultMpeg4Gif = InlineQueryResultMpeg4Gif::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'mpeg4_gif'], $inlineQueryResultMpeg4Gif->toArray());
    }
}
