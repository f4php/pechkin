<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultLocation;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultLocationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_location_full.json');
        $inlineQueryResultLocation = InlineQueryResultLocation::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultLocation::class, $inlineQueryResultLocation);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultLocation->reply_markup);
        $this->assertNotNull($inlineQueryResultLocation->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultLocation->id);
        $this->assertSame(55.7558, $inlineQueryResultLocation->latitude);
        $this->assertSame(37.6173, $inlineQueryResultLocation->longitude);
        $this->assertSame('Test Title', $inlineQueryResultLocation->title);
        $this->assertSame(10.5, $inlineQueryResultLocation->horizontal_accuracy);
        $this->assertSame(3600, $inlineQueryResultLocation->live_period);
        $this->assertSame(180, $inlineQueryResultLocation->heading);
        $this->assertSame(100, $inlineQueryResultLocation->proximity_alert_radius);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultLocation->input_message_content);
        $this->assertSame('https://example.com/thumb.jpg', $inlineQueryResultLocation->thumbnail_url);
        $this->assertSame(160, $inlineQueryResultLocation->thumbnail_width);
        $this->assertSame(120, $inlineQueryResultLocation->thumbnail_height);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_location_minimal.json');
        $inlineQueryResultLocation = InlineQueryResultLocation::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultLocation::class, $inlineQueryResultLocation);
        $this->assertNull($inlineQueryResultLocation->horizontal_accuracy);
        $this->assertNull($inlineQueryResultLocation->live_period);
        $this->assertNull($inlineQueryResultLocation->heading);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_location_minimal.json');
        $inlineQueryResultLocation = InlineQueryResultLocation::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'location'], $inlineQueryResultLocation->toArray());
    }
}
