<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BusinessOpeningHours;

final class BusinessOpeningHoursTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'time_zone_name' => 'America/New_York',
            'opening_hours' => [
                ['opening_minute' => 540, 'closing_minute' => 1020],
            ],
        ];
        $hours = BusinessOpeningHours::fromArray($data);
        $this->assertSame('America/New_York', $hours->time_zone_name);
        $this->assertIsArray($hours->opening_hours);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'time_zone_name' => 'Asia/Tokyo',
            'opening_hours' => [
                ['opening_minute' => 540, 'closing_minute' => 1020],
            ],
        ];
        $hours = BusinessOpeningHours::fromArray($data);
        $this->assertSame($data, $hours->toArray());
    }
}
