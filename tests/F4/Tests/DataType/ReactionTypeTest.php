<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ReactionType;
use F4\Pechkin\DataType\ReactionTypeEmoji;
use F4\Pechkin\DataType\ReactionTypeCustomEmoji;
use F4\Pechkin\DataType\ReactionTypePaid;

final class ReactionTypeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithEmojiType(): void
    {
        $data = [
            ...$this->loadFixture('reaction_type_emoji_full.json'),
            'type' => 'emoji',
        ];
        $result = ReactionType::fromArray($data);
        $this->assertInstanceOf(ReactionTypeEmoji::class, $result);
    }

    public function testFromArrayWithCustomEmojiType(): void
    {
        $data = [
            ...$this->loadFixture('reaction_type_custom_emoji_full.json'),
            'type' => 'custom_emoji',
        ];
        $result = ReactionType::fromArray($data);
        $this->assertInstanceOf(ReactionTypeCustomEmoji::class, $result);
    }

    public function testFromArrayWithPaidType(): void
    {
        $data = [
            'type' => 'paid',
        ];
        $result = ReactionType::fromArray($data);
        $this->assertInstanceOf(ReactionTypePaid::class, $result);
    }
}
