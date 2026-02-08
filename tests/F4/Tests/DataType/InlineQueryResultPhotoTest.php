<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultPhoto;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultPhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_photo_full.json');
        $inlineQueryResultPhoto = InlineQueryResultPhoto::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultPhoto::class, $inlineQueryResultPhoto);
        $this->assertNotEmpty($inlineQueryResultPhoto->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultPhoto->reply_markup);
        $this->assertNotNull($inlineQueryResultPhoto->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultPhoto->id);
        $this->assertSame('https://example.com/photo.jpg', $inlineQueryResultPhoto->photo_url);
        $this->assertSame('https://example.com/thumb.jpg', $inlineQueryResultPhoto->thumbnail_url);
        $this->assertSame(640, $inlineQueryResultPhoto->photo_width);
        $this->assertSame(480, $inlineQueryResultPhoto->photo_height);
        $this->assertSame('Test Title', $inlineQueryResultPhoto->title);
        $this->assertSame('Test description', $inlineQueryResultPhoto->description);
        $this->assertSame('Test caption', $inlineQueryResultPhoto->caption);
        $this->assertSame('HTML', $inlineQueryResultPhoto->parse_mode);
        $this->assertSame(false, $inlineQueryResultPhoto->show_caption_above_media);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultPhoto->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_photo_minimal.json');
        $inlineQueryResultPhoto = InlineQueryResultPhoto::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultPhoto::class, $inlineQueryResultPhoto);
        $this->assertNull($inlineQueryResultPhoto->photo_width);
        $this->assertNull($inlineQueryResultPhoto->photo_height);
        $this->assertNull($inlineQueryResultPhoto->title);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_photo_minimal.json');
        $inlineQueryResultPhoto = InlineQueryResultPhoto::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'photo'], $inlineQueryResultPhoto->toArray());
    }
}
