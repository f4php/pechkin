<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\GiveawayWinners;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class GiveawayWinnersTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('giveaway_winners_full.json');
        $giveawayWinners = GiveawayWinners::fromArray($data);

        $this->assertInstanceOf(GiveawayWinners::class, $giveawayWinners);
        $this->assertInstanceOf(Chat::class, $giveawayWinners->chat);
        $this->assertNotEmpty($giveawayWinners->winners);
        $this->assertSame(42, $giveawayWinners->giveaway_message_id);
        $this->assertSame(42, $giveawayWinners->winners_selection_date);
        $this->assertSame(5, $giveawayWinners->winner_count);
        $this->assertSame(3, $giveawayWinners->additional_chat_count);
        $this->assertSame(100, $giveawayWinners->prize_star_count);
        $this->assertSame(42, $giveawayWinners->premium_subscription_month_count);
        $this->assertSame(2, $giveawayWinners->unclaimed_prize_count);
        $this->assertSame(false, $giveawayWinners->only_new_members);
        $this->assertSame(false, $giveawayWinners->was_refunded);
        $this->assertSame('Win a prize!', $giveawayWinners->prize_description);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('giveaway_winners_minimal.json');
        $giveawayWinners = GiveawayWinners::fromArray($data);

        $this->assertInstanceOf(GiveawayWinners::class, $giveawayWinners);
        $this->assertNull($giveawayWinners->additional_chat_count);
        $this->assertNull($giveawayWinners->prize_star_count);
        $this->assertNull($giveawayWinners->premium_subscription_month_count);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('giveaway_winners_minimal.json');
        $giveawayWinners = GiveawayWinners::fromArray($data);
        $this->assertEquals($data, $giveawayWinners->toArray());
    }
}
