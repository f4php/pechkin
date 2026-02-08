<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BusinessLocation;
use F4\Pechkin\DataType\Location;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BusinessLocationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('business_location_full.json');
        $businessLocation = BusinessLocation::fromArray($data);

        $this->assertInstanceOf(BusinessLocation::class, $businessLocation);
        $this->assertInstanceOf(Location::class, $businessLocation->location);
        $this->assertSame('123 Main St', $businessLocation->address);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('business_location_minimal.json');
        $businessLocation = BusinessLocation::fromArray($data);

        $this->assertInstanceOf(BusinessLocation::class, $businessLocation);
        $this->assertNull($businessLocation->location);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('business_location_minimal.json');
        $businessLocation = BusinessLocation::fromArray($data);
        $this->assertEquals($data, $businessLocation->toArray());
    }
}
