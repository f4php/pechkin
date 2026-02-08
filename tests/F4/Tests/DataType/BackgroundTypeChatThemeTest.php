<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BackgroundTypeChatTheme;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BackgroundTypeChatThemeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('background_type_chat_theme_full.json');
        $backgroundTypeChatTheme = BackgroundTypeChatTheme::fromArray($data);

        $this->assertInstanceOf(BackgroundTypeChatTheme::class, $backgroundTypeChatTheme);
        $this->assertSame('dark', $backgroundTypeChatTheme->theme_name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('background_type_chat_theme_minimal.json');
        $backgroundTypeChatTheme = BackgroundTypeChatTheme::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'chat_theme'], $backgroundTypeChatTheme->toArray());
    }
}
