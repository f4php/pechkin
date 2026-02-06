<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BackgroundType;
use F4\Pechkin\DataType\BackgroundTypeWallpaper;
use F4\Pechkin\DataType\BackgroundTypeFill;
use F4\Pechkin\DataType\BackgroundTypePattern;
use F4\Pechkin\DataType\BackgroundTypeChatTheme;

final class BackgroundTypeTest extends TestCase
{
    public function testFromArrayWithWallpaperType(): void
    {
        $data = [
            'type' => 'wallpaper',
            'document' => [
                'file_id' => 'abc123',
                'file_unique_id' => 'unique123',
            ],
            'dark_theme_dimming' => 50,
        ];
        $result = BackgroundType::fromArray($data);
        $this->assertInstanceOf(BackgroundTypeWallpaper::class, $result);
        $this->assertSame(50, $result->dark_theme_dimming);
    }

    public function testFromArrayWithFillType(): void
    {
        $data = [
            'type' => 'fill',
            'fill' => [
                'type' => 'solid',
                'color' => 16777215,
            ],
            'dark_theme_dimming' => 30,
        ];
        $result = BackgroundType::fromArray($data);
        $this->assertInstanceOf(BackgroundTypeFill::class, $result);
        $this->assertSame(30, $result->dark_theme_dimming);
    }

    public function testFromArrayWithPatternType(): void
    {
        $data = [
            'type' => 'pattern',
            'document' => [
                'file_id' => 'abc123',
                'file_unique_id' => 'unique123',
            ],
            'fill' => [
                'type' => 'solid',
                'color' => 16777215,
            ],
            'intensity' => 80,
        ];
        $result = BackgroundType::fromArray($data);
        $this->assertInstanceOf(BackgroundTypePattern::class, $result);
        $this->assertSame(80, $result->intensity);
    }

    public function testFromArrayWithChatThemeType(): void
    {
        $data = [
            'type' => 'chat_theme',
            'theme_name' => 'dark_blue',
        ];
        $result = BackgroundType::fromArray($data);
        $this->assertInstanceOf(BackgroundTypeChatTheme::class, $result);
        $this->assertSame('dark_blue', $result->theme_name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'type' => 'chat_theme',
            'theme_name' => 'dark_blue',
        ];
        $result = BackgroundType::fromArray($data);
        $this->assertSame('dark_blue', $result->toArray());
    }
}
