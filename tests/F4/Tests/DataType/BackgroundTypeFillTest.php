<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BackgroundTypeFill;
use F4\Pechkin\DataType\BackgroundFill;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BackgroundTypeFillTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('background_type_fill_full.json');
        $backgroundTypeFill = BackgroundTypeFill::fromArray($data);

        $this->assertInstanceOf(BackgroundTypeFill::class, $backgroundTypeFill);
        $this->assertNotNull($backgroundTypeFill->fill);
        $this->assertInstanceOf(BackgroundFill::class, $backgroundTypeFill->fill);
        $this->assertSame(50, $backgroundTypeFill->dark_theme_dimming);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('background_type_fill_minimal.json');
        $backgroundTypeFill = BackgroundTypeFill::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'fill'], $backgroundTypeFill->toArray());
    }
}
