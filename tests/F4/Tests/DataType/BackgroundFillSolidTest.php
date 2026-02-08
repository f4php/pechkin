<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BackgroundFillSolid;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BackgroundFillSolidTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('background_fill_solid_full.json');
        $backgroundFillSolid = BackgroundFillSolid::fromArray($data);

        $this->assertInstanceOf(BackgroundFillSolid::class, $backgroundFillSolid);
        $this->assertSame(16711680, $backgroundFillSolid->color);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('background_fill_solid_minimal.json');
        $backgroundFillSolid = BackgroundFillSolid::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'solid'], $backgroundFillSolid->toArray());
    }
}
