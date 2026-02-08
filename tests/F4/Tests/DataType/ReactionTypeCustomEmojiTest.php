<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ReactionTypeCustomEmoji;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ReactionTypeCustomEmojiTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('reaction_type_custom_emoji_full.json');
        $reactionTypeCustomEmoji = ReactionTypeCustomEmoji::fromArray($data);

        $this->assertInstanceOf(ReactionTypeCustomEmoji::class, $reactionTypeCustomEmoji);
        $this->assertSame('emoji_456', $reactionTypeCustomEmoji->custom_emoji_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('reaction_type_custom_emoji_minimal.json');
        $reactionTypeCustomEmoji = ReactionTypeCustomEmoji::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'custom_emoji'], $reactionTypeCustomEmoji->toArray());
    }
}
