<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\UniqueGiftBackdropColors;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UniqueGiftBackdropColorsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('unique_gift_backdrop_colors_full.json');
        $uniqueGiftBackdropColors = UniqueGiftBackdropColors::fromArray($data);

        $this->assertInstanceOf(UniqueGiftBackdropColors::class, $uniqueGiftBackdropColors);
        $this->assertSame(16711680, $uniqueGiftBackdropColors->center_color);
        $this->assertSame(255, $uniqueGiftBackdropColors->edge_color);
        $this->assertSame(65280, $uniqueGiftBackdropColors->symbol_color);
        $this->assertSame(16777215, $uniqueGiftBackdropColors->text_color);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('unique_gift_backdrop_colors_minimal.json');
        $uniqueGiftBackdropColors = UniqueGiftBackdropColors::fromArray($data);
        $this->assertEquals($data, $uniqueGiftBackdropColors->toArray());
    }
}
