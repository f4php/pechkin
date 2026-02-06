<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BusinessLocation;
use F4\Pechkin\DataType\Location;

final class BusinessLocationTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'address' => '456 Oak Ave, Town',
            'location' => ['longitude' => 10.5, 'latitude' => 20.5],
        ];
        $location = BusinessLocation::fromArray($data);
        $this->assertSame('123 Main St, City', $location->address);
        $this->assertInstanceOf(Location::class, $location->location);
    }

    public function testToArrayWithMinimalData(): void
    {
        $data = [
            'address' => '456 Oak Ave, Town',
        ];
        $location = BusinessLocation::fromArray($data);
        $this->assertSame('456 Oak Ave, Town', $location->address);
        $this->assertNull($location->location);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = ['address' => '789 Pine Rd, Village'];
        $location = BusinessLocation::fromArray($data);
        $this->assertSame($data, $location->toArray());
    }
}
