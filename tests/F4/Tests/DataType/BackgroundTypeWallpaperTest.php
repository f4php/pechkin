<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BackgroundTypeWallpaper;
use F4\Pechkin\DataType\Document;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BackgroundTypeWallpaperTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('background_type_wallpaper_full.json');
        $backgroundTypeWallpaper = BackgroundTypeWallpaper::fromArray($data);

        $this->assertInstanceOf(BackgroundTypeWallpaper::class, $backgroundTypeWallpaper);
        $this->assertInstanceOf(Document::class, $backgroundTypeWallpaper->document);
        $this->assertSame(50, $backgroundTypeWallpaper->dark_theme_dimming);
        $this->assertSame(true, $backgroundTypeWallpaper->is_blurred);
        $this->assertSame(false, $backgroundTypeWallpaper->is_moving);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('background_type_wallpaper_minimal.json');
        $backgroundTypeWallpaper = BackgroundTypeWallpaper::fromArray($data);

        $this->assertInstanceOf(BackgroundTypeWallpaper::class, $backgroundTypeWallpaper);
        $this->assertNull($backgroundTypeWallpaper->is_blurred);
        $this->assertNull($backgroundTypeWallpaper->is_moving);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('background_type_wallpaper_minimal.json');
        $backgroundTypeWallpaper = BackgroundTypeWallpaper::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'wallpaper'], $backgroundTypeWallpaper->toArray());
    }
}
