<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\MaskPosition;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MaskPositionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('mask_position_full.json');
        $maskPosition = MaskPosition::fromArray($data);

        $this->assertInstanceOf(MaskPosition::class, $maskPosition);
        $this->assertSame('forehead', $maskPosition->point);
        $this->assertSame(0.5, $maskPosition->x_shift);
        $this->assertSame(0.5, $maskPosition->y_shift);
        $this->assertSame(100.0, $maskPosition->scale);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('mask_position_minimal.json');
        $maskPosition = MaskPosition::fromArray($data);
        $this->assertEquals($data, $maskPosition->toArray());
    }
}
