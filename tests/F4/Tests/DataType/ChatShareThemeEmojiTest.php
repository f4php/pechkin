<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatShareThemeEmoji;
use F4\Pechkin\DataType\EmojiTypeCustomEmoji;
use F4\Pechkin\DataType\EmojiTypeEmoji;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatShareThemeEmojiTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_share_theme_emoji_full.json');
        $chatShareThemeEmoji = ChatShareThemeEmoji::fromArray($data);

        $this->assertInstanceOf(ChatShareThemeEmoji::class, $chatShareThemeEmoji);
        $this->assertSame('emoji', $chatShareThemeEmoji->type);
        $this->assertCount(2, $chatShareThemeEmoji->emojis);
        $this->assertInstanceOf(EmojiTypeEmoji::class, $chatShareThemeEmoji->emojis[0]);
        $this->assertSame('🎲', $chatShareThemeEmoji->emojis[0]->emoji);
        $this->assertInstanceOf(EmojiTypeCustomEmoji::class, $chatShareThemeEmoji->emojis[1]);
        $this->assertSame('5368324170671202286', $chatShareThemeEmoji->emojis[1]->custom_emoji_id);
        $this->assertSame(42, $chatShareThemeEmoji->background_backdrop_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_share_theme_emoji_minimal.json');
        $chatShareThemeEmoji = ChatShareThemeEmoji::fromArray($data);

        $this->assertInstanceOf(ChatShareThemeEmoji::class, $chatShareThemeEmoji);
        $this->assertNull($chatShareThemeEmoji->background_backdrop_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_share_theme_emoji_minimal.json');
        $chatShareThemeEmoji = ChatShareThemeEmoji::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'emoji'], $chatShareThemeEmoji->toArray());
    }
}
