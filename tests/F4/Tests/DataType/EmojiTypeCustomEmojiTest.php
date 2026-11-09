<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\EmojiTypeCustomEmoji;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class EmojiTypeCustomEmojiTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('emoji_type_custom_emoji_full.json');
        $emojiTypeCustomEmoji = EmojiTypeCustomEmoji::fromArray($data);

        $this->assertInstanceOf(EmojiTypeCustomEmoji::class, $emojiTypeCustomEmoji);
        $this->assertSame('custom_emoji', $emojiTypeCustomEmoji->type);
        $this->assertSame('5368324170671202286', $emojiTypeCustomEmoji->custom_emoji_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('emoji_type_custom_emoji_minimal.json');
        $emojiTypeCustomEmoji = EmojiTypeCustomEmoji::fromArray($data);

        $this->assertInstanceOf(EmojiTypeCustomEmoji::class, $emojiTypeCustomEmoji);
        $this->assertSame('5368324170671202286', $emojiTypeCustomEmoji->custom_emoji_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('emoji_type_custom_emoji_minimal.json');
        $emojiTypeCustomEmoji = EmojiTypeCustomEmoji::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'custom_emoji'], $emojiTypeCustomEmoji->toArray());
    }
}
