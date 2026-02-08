<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatBoostSourceGiveaway;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatBoostSourceGiveawayTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_boost_source_giveaway_full.json');
        $chatBoostSourceGiveaway = ChatBoostSourceGiveaway::fromArray($data);

        $this->assertInstanceOf(ChatBoostSourceGiveaway::class, $chatBoostSourceGiveaway);
        $this->assertInstanceOf(User::class, $chatBoostSourceGiveaway->user);
        $this->assertSame(42, $chatBoostSourceGiveaway->giveaway_message_id);
        $this->assertSame(100, $chatBoostSourceGiveaway->prize_star_count);
        $this->assertSame(false, $chatBoostSourceGiveaway->is_unclaimed);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_boost_source_giveaway_minimal.json');
        $chatBoostSourceGiveaway = ChatBoostSourceGiveaway::fromArray($data);

        $this->assertInstanceOf(ChatBoostSourceGiveaway::class, $chatBoostSourceGiveaway);
        $this->assertNull($chatBoostSourceGiveaway->user);
        $this->assertNull($chatBoostSourceGiveaway->prize_star_count);
        $this->assertNull($chatBoostSourceGiveaway->is_unclaimed);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_boost_source_giveaway_minimal.json');
        $chatBoostSourceGiveaway = ChatBoostSourceGiveaway::fromArray($data);
        $this->assertEquals([...$data, 'source' => 'giveaway'], $chatBoostSourceGiveaway->toArray());
    }
}
