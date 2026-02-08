<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultCachedMpeg4Gif;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultCachedMpeg4GifTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_mpeg4_gif_full.json');
        $inlineQueryResultCachedMpeg4Gif = InlineQueryResultCachedMpeg4Gif::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedMpeg4Gif::class, $inlineQueryResultCachedMpeg4Gif);
        $this->assertNotEmpty($inlineQueryResultCachedMpeg4Gif->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultCachedMpeg4Gif->reply_markup);
        $this->assertNotNull($inlineQueryResultCachedMpeg4Gif->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultCachedMpeg4Gif->id);
        $this->assertSame('test_string', $inlineQueryResultCachedMpeg4Gif->mpeg4_file_id);
        $this->assertSame('Test Title', $inlineQueryResultCachedMpeg4Gif->title);
        $this->assertSame('Test caption', $inlineQueryResultCachedMpeg4Gif->caption);
        $this->assertSame('HTML', $inlineQueryResultCachedMpeg4Gif->parse_mode);
        $this->assertSame(false, $inlineQueryResultCachedMpeg4Gif->show_caption_above_media);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultCachedMpeg4Gif->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_mpeg4_gif_minimal.json');
        $inlineQueryResultCachedMpeg4Gif = InlineQueryResultCachedMpeg4Gif::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedMpeg4Gif::class, $inlineQueryResultCachedMpeg4Gif);
        $this->assertNull($inlineQueryResultCachedMpeg4Gif->title);
        $this->assertNull($inlineQueryResultCachedMpeg4Gif->caption);
        $this->assertNull($inlineQueryResultCachedMpeg4Gif->parse_mode);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_mpeg4_gif_minimal.json');
        $inlineQueryResultCachedMpeg4Gif = InlineQueryResultCachedMpeg4Gif::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'mpeg4_gif'], $inlineQueryResultCachedMpeg4Gif->toArray());
    }
}
