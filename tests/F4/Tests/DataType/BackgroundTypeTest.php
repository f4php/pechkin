<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BackgroundType;
use F4\Pechkin\DataType\BackgroundTypeWallpaper;
use F4\Pechkin\DataType\BackgroundTypeFill;
use F4\Pechkin\DataType\BackgroundTypePattern;
use F4\Pechkin\DataType\BackgroundTypeChatTheme;

final class BackgroundTypeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithWallpaperType(): void
    {
        $data = [
            ...$this->loadFixture('background_type_wallpaper_full.json'),
            'type' => 'wallpaper',
        ];
        $result = BackgroundType::fromArray($data);
        $this->assertInstanceOf(BackgroundTypeWallpaper::class, $result);
    }

    public function testFromArrayWithFillType(): void
    {
        $data = [
            ...$this->loadFixture('background_type_fill_full.json'),
            'type' => 'fill',
        ];
        $result = BackgroundType::fromArray($data);
        $this->assertInstanceOf(BackgroundTypeFill::class, $result);
    }

    public function testFromArrayWithPatternType(): void
    {
        $data = [
            ...$this->loadFixture('background_type_pattern_full.json'),
            'type' => 'pattern',
        ];
        $result = BackgroundType::fromArray($data);
        $this->assertInstanceOf(BackgroundTypePattern::class, $result);
    }

    public function testFromArrayWithChatThemeType(): void
    {
        $data = [
            ...$this->loadFixture('background_type_chat_theme_full.json'),
            'type' => 'chat_theme',
        ];
        $result = BackgroundType::fromArray($data);
        $this->assertInstanceOf(BackgroundTypeChatTheme::class, $result);
    }
}
