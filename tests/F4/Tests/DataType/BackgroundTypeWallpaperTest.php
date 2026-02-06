<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BackgroundTypeWallpaper;
use F4\Pechkin\DataType\Document;

final class BackgroundTypeWallpaperTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'document' => ['file_id' => 'abc123', 'file_unique_id' => 'xyz789'],
            'dark_theme_dimming' => 50,
            'is_blurred' => true,
            'is_moving' => true,
        ];
        $wallpaper = BackgroundTypeWallpaper::fromArray($data);
        $this->assertInstanceOf(Document::class, $wallpaper->document);
        $this->assertSame(50, $wallpaper->dark_theme_dimming);
        $this->assertSame(true, $wallpaper->is_blurred);
        $this->assertSame(true, $wallpaper->is_moving);
    }
    public function testFromArrayCreatesCorrectStructureMinimalData(): void
    {
        $data = [
            'document' => ['file_id' => 'abc123', 'file_unique_id' => 'xyz789'],
            'dark_theme_dimming' => 50,
        ];
        $wallpaper = BackgroundTypeWallpaper::fromArray($data);
        $this->assertInstanceOf(Document::class, $wallpaper->document);
        $this->assertSame(50, $wallpaper->dark_theme_dimming);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'document' => ['file_id' => 'ghi789', 'file_unique_id' => 'rst456'],
            'dark_theme_dimming' => 75,
        ];
        $wallpaper = BackgroundTypeWallpaper::fromArray($data);
        $this->assertSame($data, $wallpaper->toArray());
    }
}
