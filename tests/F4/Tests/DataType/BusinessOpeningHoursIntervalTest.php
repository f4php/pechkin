<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BusinessOpeningHoursInterval;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BusinessOpeningHoursIntervalTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('business_opening_hours_interval_full.json');
        $businessOpeningHoursInterval = BusinessOpeningHoursInterval::fromArray($data);

        $this->assertInstanceOf(BusinessOpeningHoursInterval::class, $businessOpeningHoursInterval);
        $this->assertSame(0, $businessOpeningHoursInterval->opening_minute);
        $this->assertSame(1440, $businessOpeningHoursInterval->closing_minute);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('business_opening_hours_interval_minimal.json');
        $businessOpeningHoursInterval = BusinessOpeningHoursInterval::fromArray($data);
        $this->assertEquals($data, $businessOpeningHoursInterval->toArray());
    }
}
