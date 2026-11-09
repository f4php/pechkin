<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatShareThemeUniqueGift;
use F4\Pechkin\DataType\UniqueGift;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatShareThemeUniqueGiftTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_share_theme_unique_gift_full.json');
        $chatShareThemeUniqueGift = ChatShareThemeUniqueGift::fromArray($data);

        $this->assertInstanceOf(ChatShareThemeUniqueGift::class, $chatShareThemeUniqueGift);
        $this->assertSame('unique_gift', $chatShareThemeUniqueGift->type);
        $this->assertInstanceOf(UniqueGift::class, $chatShareThemeUniqueGift->gift);
        $this->assertSame('Test Name', $chatShareThemeUniqueGift->gift->name);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_share_theme_unique_gift_minimal.json');
        $chatShareThemeUniqueGift = ChatShareThemeUniqueGift::fromArray($data);

        $this->assertInstanceOf(ChatShareThemeUniqueGift::class, $chatShareThemeUniqueGift);
        $this->assertInstanceOf(UniqueGift::class, $chatShareThemeUniqueGift->gift);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_share_theme_unique_gift_minimal.json');
        $chatShareThemeUniqueGift = ChatShareThemeUniqueGift::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'unique_gift'], $chatShareThemeUniqueGift->toArray());
    }
}
