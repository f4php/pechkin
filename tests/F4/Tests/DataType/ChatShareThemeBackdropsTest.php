<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatShareThemeBackdrop;
use F4\Pechkin\DataType\ChatShareThemeBackdrops;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatShareThemeBackdropsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_share_theme_backdrops_full.json');
        $chatShareThemeBackdrops = ChatShareThemeBackdrops::fromArray($data);

        $this->assertInstanceOf(ChatShareThemeBackdrops::class, $chatShareThemeBackdrops);
        $this->assertCount(2, $chatShareThemeBackdrops->backdrops);
        $this->assertInstanceOf(ChatShareThemeBackdrop::class, $chatShareThemeBackdrops->backdrops[0]);
        $this->assertSame(42, $chatShareThemeBackdrops->backdrops[0]->id);
        $this->assertSame('Other Name', $chatShareThemeBackdrops->backdrops[1]->name);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_share_theme_backdrops_minimal.json');
        $chatShareThemeBackdrops = ChatShareThemeBackdrops::fromArray($data);

        $this->assertInstanceOf(ChatShareThemeBackdrops::class, $chatShareThemeBackdrops);
        $this->assertCount(1, $chatShareThemeBackdrops->backdrops);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_share_theme_backdrops_minimal.json');
        $chatShareThemeBackdrops = ChatShareThemeBackdrops::fromArray($data);
        $this->assertEquals($data, $chatShareThemeBackdrops->toArray());
    }
}
