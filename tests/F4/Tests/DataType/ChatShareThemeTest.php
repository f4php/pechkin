<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatShareTheme;
use F4\Pechkin\DataType\ChatShareThemeEmoji;
use F4\Pechkin\DataType\ChatShareThemeUniqueGift;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatShareThemeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithEmojiType(): void
    {
        $data = [
            ...$this->loadFixture('chat_share_theme_emoji_full.json'),
            'type' => 'emoji',
        ];
        $result = ChatShareTheme::fromArray($data);
        $this->assertInstanceOf(ChatShareThemeEmoji::class, $result);
    }

    public function testFromArrayWithUniqueGiftType(): void
    {
        $data = [
            ...$this->loadFixture('chat_share_theme_unique_gift_full.json'),
            'type' => 'unique_gift',
        ];
        $result = ChatShareTheme::fromArray($data);
        $this->assertInstanceOf(ChatShareThemeUniqueGift::class, $result);
    }
}
