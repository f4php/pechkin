<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\LocationAddress;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class LocationAddressTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('location_address_full.json');
        $locationAddress = LocationAddress::fromArray($data);

        $this->assertInstanceOf(LocationAddress::class, $locationAddress);
        $this->assertSame('US', $locationAddress->country_code);
        $this->assertSame('California', $locationAddress->state);
        $this->assertSame('San Francisco', $locationAddress->city);
        $this->assertSame('test_string', $locationAddress->street);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('location_address_minimal.json');
        $locationAddress = LocationAddress::fromArray($data);

        $this->assertInstanceOf(LocationAddress::class, $locationAddress);
        $this->assertNull($locationAddress->state);
        $this->assertNull($locationAddress->city);
        $this->assertNull($locationAddress->street);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('location_address_minimal.json');
        $locationAddress = LocationAddress::fromArray($data);
        $this->assertEquals($data, $locationAddress->toArray());
    }
}
