<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\EmojiType;
use F4\Pechkin\DataType\EmojiTypeCustomEmoji;
use F4\Pechkin\DataType\EmojiTypeEmoji;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class EmojiTypeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithEmojiType(): void
    {
        $data = [
            ...$this->loadFixture('emoji_type_emoji_full.json'),
            'type' => 'emoji',
        ];
        $result = EmojiType::fromArray($data);
        $this->assertInstanceOf(EmojiTypeEmoji::class, $result);
    }

    public function testFromArrayWithCustomEmojiType(): void
    {
        $data = [
            ...$this->loadFixture('emoji_type_custom_emoji_full.json'),
            'type' => 'custom_emoji',
        ];
        $result = EmojiType::fromArray($data);
        $this->assertInstanceOf(EmojiTypeCustomEmoji::class, $result);
    }
}
