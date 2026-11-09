<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatShareThemeBackdrop;
use F4\Pechkin\DataType\UniqueGiftBackdropColors;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatShareThemeBackdropTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_share_theme_backdrop_full.json');
        $chatShareThemeBackdrop = ChatShareThemeBackdrop::fromArray($data);

        $this->assertInstanceOf(ChatShareThemeBackdrop::class, $chatShareThemeBackdrop);
        $this->assertSame(42, $chatShareThemeBackdrop->id);
        $this->assertSame('Test Name', $chatShareThemeBackdrop->name);
        $this->assertInstanceOf(UniqueGiftBackdropColors::class, $chatShareThemeBackdrop->colors);
        $this->assertSame(16711680, $chatShareThemeBackdrop->colors->center_color);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_share_theme_backdrop_minimal.json');
        $chatShareThemeBackdrop = ChatShareThemeBackdrop::fromArray($data);

        $this->assertInstanceOf(ChatShareThemeBackdrop::class, $chatShareThemeBackdrop);
        $this->assertSame(42, $chatShareThemeBackdrop->id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_share_theme_backdrop_minimal.json');
        $chatShareThemeBackdrop = ChatShareThemeBackdrop::fromArray($data);
        $this->assertEquals($data, $chatShareThemeBackdrop->toArray());
    }
}
