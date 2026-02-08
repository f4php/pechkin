<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultCachedSticker;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultCachedStickerTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_sticker_full.json');
        $inlineQueryResultCachedSticker = InlineQueryResultCachedSticker::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedSticker::class, $inlineQueryResultCachedSticker);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultCachedSticker->reply_markup);
        $this->assertNotNull($inlineQueryResultCachedSticker->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultCachedSticker->id);
        $this->assertSame('test_string', $inlineQueryResultCachedSticker->sticker_file_id);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultCachedSticker->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_sticker_minimal.json');
        $inlineQueryResultCachedSticker = InlineQueryResultCachedSticker::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedSticker::class, $inlineQueryResultCachedSticker);
        $this->assertNull($inlineQueryResultCachedSticker->reply_markup);
        $this->assertNull($inlineQueryResultCachedSticker->input_message_content);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_sticker_minimal.json');
        $inlineQueryResultCachedSticker = InlineQueryResultCachedSticker::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'sticker'], $inlineQueryResultCachedSticker->toArray());
    }
}
