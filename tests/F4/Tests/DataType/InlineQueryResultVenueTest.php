<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultVenue;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultVenueTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_venue_full.json');
        $inlineQueryResultVenue = InlineQueryResultVenue::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultVenue::class, $inlineQueryResultVenue);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultVenue->reply_markup);
        $this->assertNotNull($inlineQueryResultVenue->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultVenue->id);
        $this->assertSame(55.7558, $inlineQueryResultVenue->latitude);
        $this->assertSame(37.6173, $inlineQueryResultVenue->longitude);
        $this->assertSame('Test Title', $inlineQueryResultVenue->title);
        $this->assertSame('123 Main St', $inlineQueryResultVenue->address);
        $this->assertSame('abc123foursquare', $inlineQueryResultVenue->foursquare_id);
        $this->assertSame('food/restaurant', $inlineQueryResultVenue->foursquare_type);
        $this->assertSame('ChIJN1t_tDeuEmsRUsoyG83frY4', $inlineQueryResultVenue->google_place_id);
        $this->assertSame('restaurant', $inlineQueryResultVenue->google_place_type);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultVenue->input_message_content);
        $this->assertSame('https://example.com/thumb.jpg', $inlineQueryResultVenue->thumbnail_url);
        $this->assertSame(160, $inlineQueryResultVenue->thumbnail_width);
        $this->assertSame(120, $inlineQueryResultVenue->thumbnail_height);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_venue_minimal.json');
        $inlineQueryResultVenue = InlineQueryResultVenue::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultVenue::class, $inlineQueryResultVenue);
        $this->assertNull($inlineQueryResultVenue->foursquare_id);
        $this->assertNull($inlineQueryResultVenue->foursquare_type);
        $this->assertNull($inlineQueryResultVenue->google_place_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_venue_minimal.json');
        $inlineQueryResultVenue = InlineQueryResultVenue::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'venue'], $inlineQueryResultVenue->toArray());
    }
}
