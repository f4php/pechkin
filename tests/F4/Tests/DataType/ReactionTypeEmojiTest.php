<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ReactionTypeEmoji;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ReactionTypeEmojiTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('reaction_type_emoji_full.json');
        $reactionTypeEmoji = ReactionTypeEmoji::fromArray($data);

        $this->assertInstanceOf(ReactionTypeEmoji::class, $reactionTypeEmoji);
        $this->assertSame('🎲', $reactionTypeEmoji->emoji);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('reaction_type_emoji_minimal.json');
        $reactionTypeEmoji = ReactionTypeEmoji::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'emoji'], $reactionTypeEmoji->toArray());
    }
}
