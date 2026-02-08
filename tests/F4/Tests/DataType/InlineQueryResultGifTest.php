<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultGif;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultGifTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_gif_full.json');
        $inlineQueryResultGif = InlineQueryResultGif::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultGif::class, $inlineQueryResultGif);
        $this->assertNotEmpty($inlineQueryResultGif->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultGif->reply_markup);
        $this->assertNotNull($inlineQueryResultGif->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultGif->id);
        $this->assertSame('https://example.com/animation.gif', $inlineQueryResultGif->gif_url);
        $this->assertSame('https://example.com/thumb.jpg', $inlineQueryResultGif->thumbnail_url);
        $this->assertSame(320, $inlineQueryResultGif->gif_width);
        $this->assertSame(240, $inlineQueryResultGif->gif_height);
        $this->assertSame(5, $inlineQueryResultGif->gif_duration);
        $this->assertSame('test_string', $inlineQueryResultGif->thumbnail_mime_type);
        $this->assertSame('Test Title', $inlineQueryResultGif->title);
        $this->assertSame('Test caption', $inlineQueryResultGif->caption);
        $this->assertSame('HTML', $inlineQueryResultGif->parse_mode);
        $this->assertSame(false, $inlineQueryResultGif->show_caption_above_media);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultGif->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_gif_minimal.json');
        $inlineQueryResultGif = InlineQueryResultGif::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultGif::class, $inlineQueryResultGif);
        $this->assertNull($inlineQueryResultGif->gif_width);
        $this->assertNull($inlineQueryResultGif->gif_height);
        $this->assertNull($inlineQueryResultGif->gif_duration);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_gif_minimal.json');
        $inlineQueryResultGif = InlineQueryResultGif::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'gif'], $inlineQueryResultGif->toArray());
    }
}
