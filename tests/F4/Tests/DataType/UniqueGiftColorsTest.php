<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\UniqueGiftColors;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UniqueGiftColorsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('unique_gift_colors_full.json');
        $uniqueGiftColors = UniqueGiftColors::fromArray($data);

        $this->assertInstanceOf(UniqueGiftColors::class, $uniqueGiftColors);
        $this->assertNotEmpty($uniqueGiftColors->light_theme_other_colors);
        $this->assertNotEmpty($uniqueGiftColors->dark_theme_other_colors);
        $this->assertSame(42, $uniqueGiftColors->model_custom_emoji_id);
        $this->assertSame('test_string', $uniqueGiftColors->symbol_custom_emoji_id);
        $this->assertSame(42, $uniqueGiftColors->light_theme_main_color);
        $this->assertSame(42, $uniqueGiftColors->dark_theme_main_color);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('unique_gift_colors_minimal.json');
        $uniqueGiftColors = UniqueGiftColors::fromArray($data);
        $this->assertEquals($data, $uniqueGiftColors->toArray());
    }
}
