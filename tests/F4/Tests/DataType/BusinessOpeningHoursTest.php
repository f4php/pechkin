<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BusinessOpeningHours;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BusinessOpeningHoursTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('business_opening_hours_full.json');
        $businessOpeningHours = BusinessOpeningHours::fromArray($data);

        $this->assertInstanceOf(BusinessOpeningHours::class, $businessOpeningHours);
        $this->assertNotEmpty($businessOpeningHours->opening_hours);
        $this->assertSame('America/New_York', $businessOpeningHours->time_zone_name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('business_opening_hours_minimal.json');
        $businessOpeningHours = BusinessOpeningHours::fromArray($data);
        $this->assertEquals($data, $businessOpeningHours->toArray());
    }
}
