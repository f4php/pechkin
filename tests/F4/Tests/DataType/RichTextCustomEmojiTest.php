<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextCustomEmoji;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextCustomEmojiTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_custom_emoji_full.json');
        $obj = RichTextCustomEmoji::fromArray($data);

        $this->assertInstanceOf(RichTextCustomEmoji::class, $obj);
        $this->assertSame('custom_emoji', $obj->type);
        $this->assertSame('emoji_123', $obj->custom_emoji_id);
        $this->assertSame(':smile:', $obj->alternative_text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_custom_emoji_full.json');
        $obj = RichTextCustomEmoji::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'custom_emoji'], $obj->toArray());
    }
}
