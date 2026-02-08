<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Location;
use F4\Pechkin\DataType\Venue;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class VenueTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('venue_full.json');
        $venue = Venue::fromArray($data);

        $this->assertInstanceOf(Venue::class, $venue);
        $this->assertInstanceOf(Location::class, $venue->location);
        $this->assertSame('Test Title', $venue->title);
        $this->assertSame('123 Main St', $venue->address);
        $this->assertSame('abc123foursquare', $venue->foursquare_id);
        $this->assertSame('food/restaurant', $venue->foursquare_type);
        $this->assertSame('ChIJN1t_tDeuEmsRUsoyG83frY4', $venue->google_place_id);
        $this->assertSame('restaurant', $venue->google_place_type);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('venue_minimal.json');
        $venue = Venue::fromArray($data);

        $this->assertInstanceOf(Venue::class, $venue);
        $this->assertNull($venue->foursquare_id);
        $this->assertNull($venue->foursquare_type);
        $this->assertNull($venue->google_place_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('venue_minimal.json');
        $venue = Venue::fromArray($data);
        $this->assertEquals($data, $venue->toArray());
    }
}
