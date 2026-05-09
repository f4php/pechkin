<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaVenue;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputMediaVenueTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_media_venue_full.json');
        $imv = InputMediaVenue::fromArray($data);

        $this->assertInstanceOf(InputMediaVenue::class, $imv);
        $this->assertSame('venue', $imv->type);
        $this->assertSame(55.7558, $imv->latitude);
        $this->assertSame(37.6173, $imv->longitude);
        $this->assertSame('Red Square', $imv->title);
        $this->assertSame('Red Square, Moscow, Russia', $imv->address);
        $this->assertSame('abc123foursquare', $imv->foursquare_id);
        $this->assertSame('food/restaurant', $imv->foursquare_type);
        $this->assertSame('ChIJN1t_tDeuEmsRUsoyG83frY4', $imv->google_place_id);
        $this->assertSame('restaurant', $imv->google_place_type);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_media_venue_minimal.json');
        $imv = InputMediaVenue::fromArray($data);

        $this->assertInstanceOf(InputMediaVenue::class, $imv);
        $this->assertNull($imv->foursquare_id);
        $this->assertNull($imv->foursquare_type);
        $this->assertNull($imv->google_place_id);
        $this->assertNull($imv->google_place_type);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_media_venue_minimal.json');
        $imv = InputMediaVenue::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'venue'], $imv->toArray());
    }
}
