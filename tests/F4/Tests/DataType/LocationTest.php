<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Location;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class LocationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('location_full.json');
        $location = Location::fromArray($data);

        $this->assertInstanceOf(Location::class, $location);
        $this->assertSame(55.7558, $location->latitude);
        $this->assertSame(37.6173, $location->longitude);
        $this->assertSame(10.5, $location->horizontal_accuracy);
        $this->assertSame(3600, $location->live_period);
        $this->assertSame(180, $location->heading);
        $this->assertSame(100, $location->proximity_alert_radius);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('location_minimal.json');
        $location = Location::fromArray($data);

        $this->assertInstanceOf(Location::class, $location);
        $this->assertNull($location->horizontal_accuracy);
        $this->assertNull($location->live_period);
        $this->assertNull($location->heading);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('location_minimal.json');
        $location = Location::fromArray($data);
        $this->assertEquals($data, $location->toArray());
    }
}
