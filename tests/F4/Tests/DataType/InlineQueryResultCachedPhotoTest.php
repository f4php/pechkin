<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultCachedPhoto;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultCachedPhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_photo_full.json');
        $inlineQueryResultCachedPhoto = InlineQueryResultCachedPhoto::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedPhoto::class, $inlineQueryResultCachedPhoto);
        $this->assertNotEmpty($inlineQueryResultCachedPhoto->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultCachedPhoto->reply_markup);
        $this->assertNotNull($inlineQueryResultCachedPhoto->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultCachedPhoto->id);
        $this->assertSame('test_string', $inlineQueryResultCachedPhoto->photo_file_id);
        $this->assertSame('Test Title', $inlineQueryResultCachedPhoto->title);
        $this->assertSame('Test description', $inlineQueryResultCachedPhoto->description);
        $this->assertSame('Test caption', $inlineQueryResultCachedPhoto->caption);
        $this->assertSame('HTML', $inlineQueryResultCachedPhoto->parse_mode);
        $this->assertSame(false, $inlineQueryResultCachedPhoto->show_caption_above_media);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultCachedPhoto->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_photo_minimal.json');
        $inlineQueryResultCachedPhoto = InlineQueryResultCachedPhoto::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedPhoto::class, $inlineQueryResultCachedPhoto);
        $this->assertNull($inlineQueryResultCachedPhoto->title);
        $this->assertNull($inlineQueryResultCachedPhoto->description);
        $this->assertNull($inlineQueryResultCachedPhoto->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_photo_minimal.json');
        $inlineQueryResultCachedPhoto = InlineQueryResultCachedPhoto::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'photo'], $inlineQueryResultCachedPhoto->toArray());
    }
}
