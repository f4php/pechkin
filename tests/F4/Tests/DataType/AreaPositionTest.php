<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\AreaPosition;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class AreaPositionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('area_position_full.json');
        $areaPosition = AreaPosition::fromArray($data);

        $this->assertInstanceOf(AreaPosition::class, $areaPosition);
        $this->assertSame(50.0, $areaPosition->x_percentage);
        $this->assertSame(50.0, $areaPosition->y_percentage);
        $this->assertSame(20.0, $areaPosition->width_percentage);
        $this->assertSame(15.0, $areaPosition->height_percentage);
        $this->assertSame(45.0, $areaPosition->rotation_angle);
        $this->assertSame(5.0, $areaPosition->corner_radius_percentage);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('area_position_minimal.json');
        $areaPosition = AreaPosition::fromArray($data);
        $this->assertEquals($data, $areaPosition->toArray());
    }
}
