<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\EmojiTypeEmoji;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class EmojiTypeEmojiTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('emoji_type_emoji_full.json');
        $emojiTypeEmoji = EmojiTypeEmoji::fromArray($data);

        $this->assertInstanceOf(EmojiTypeEmoji::class, $emojiTypeEmoji);
        $this->assertSame('emoji', $emojiTypeEmoji->type);
        $this->assertSame('🎲', $emojiTypeEmoji->emoji);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('emoji_type_emoji_minimal.json');
        $emojiTypeEmoji = EmojiTypeEmoji::fromArray($data);

        $this->assertInstanceOf(EmojiTypeEmoji::class, $emojiTypeEmoji);
        $this->assertSame('🎲', $emojiTypeEmoji->emoji);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('emoji_type_emoji_minimal.json');
        $emojiTypeEmoji = EmojiTypeEmoji::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'emoji'], $emojiTypeEmoji->toArray());
    }
}
