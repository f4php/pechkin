<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BusinessOpeningHoursInterval;

final class BusinessOpeningHoursIntervalTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'opening_minute' => 540,
            'closing_minute' => 1020,
        ];
        $interval = BusinessOpeningHoursInterval::fromArray($data);
        $this->assertSame(540, $interval->opening_minute);
        $this->assertSame(1020, $interval->closing_minute);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'opening_minute' => 480,
            'closing_minute' => 1080,
        ];
        $interval = BusinessOpeningHoursInterval::fromArray($data);
        $this->assertSame($data, $interval->toArray());
    }
}
