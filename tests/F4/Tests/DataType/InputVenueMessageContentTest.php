<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputVenueMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputVenueMessageContentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_venue_message_content_full.json');
        $inputVenueMessageContent = InputVenueMessageContent::fromArray($data);

        $this->assertInstanceOf(InputVenueMessageContent::class, $inputVenueMessageContent);
        $this->assertSame(55.7558, $inputVenueMessageContent->latitude);
        $this->assertSame(37.6173, $inputVenueMessageContent->longitude);
        $this->assertSame('Test Title', $inputVenueMessageContent->title);
        $this->assertSame('123 Main St', $inputVenueMessageContent->address);
        $this->assertSame('abc123foursquare', $inputVenueMessageContent->foursquare_id);
        $this->assertSame('food/restaurant', $inputVenueMessageContent->foursquare_type);
        $this->assertSame('ChIJN1t_tDeuEmsRUsoyG83frY4', $inputVenueMessageContent->google_place_id);
        $this->assertSame('restaurant', $inputVenueMessageContent->google_place_type);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_venue_message_content_minimal.json');
        $inputVenueMessageContent = InputVenueMessageContent::fromArray($data);

        $this->assertInstanceOf(InputVenueMessageContent::class, $inputVenueMessageContent);
        $this->assertNull($inputVenueMessageContent->foursquare_id);
        $this->assertNull($inputVenueMessageContent->foursquare_type);
        $this->assertNull($inputVenueMessageContent->google_place_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_venue_message_content_minimal.json');
        $inputVenueMessageContent = InputVenueMessageContent::fromArray($data);
        $this->assertEquals($data, $inputVenueMessageContent->toArray());
    }
}
