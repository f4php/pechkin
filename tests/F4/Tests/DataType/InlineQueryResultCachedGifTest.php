<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultCachedGif;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultCachedGifTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_gif_full.json');
        $inlineQueryResultCachedGif = InlineQueryResultCachedGif::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedGif::class, $inlineQueryResultCachedGif);
        $this->assertNotEmpty($inlineQueryResultCachedGif->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultCachedGif->reply_markup);
        $this->assertNotNull($inlineQueryResultCachedGif->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultCachedGif->id);
        $this->assertSame('test_string', $inlineQueryResultCachedGif->gif_file_id);
        $this->assertSame('Test Title', $inlineQueryResultCachedGif->title);
        $this->assertSame('Test caption', $inlineQueryResultCachedGif->caption);
        $this->assertSame('HTML', $inlineQueryResultCachedGif->parse_mode);
        $this->assertSame(false, $inlineQueryResultCachedGif->show_caption_above_media);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultCachedGif->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_gif_minimal.json');
        $inlineQueryResultCachedGif = InlineQueryResultCachedGif::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedGif::class, $inlineQueryResultCachedGif);
        $this->assertNull($inlineQueryResultCachedGif->title);
        $this->assertNull($inlineQueryResultCachedGif->caption);
        $this->assertNull($inlineQueryResultCachedGif->parse_mode);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_gif_minimal.json');
        $inlineQueryResultCachedGif = InlineQueryResultCachedGif::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'gif'], $inlineQueryResultCachedGif->toArray());
    }
}
