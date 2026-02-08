<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\GiveawayCompleted;
use F4\Pechkin\DataType\Message;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class GiveawayCompletedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('giveaway_completed_full.json');
        $giveawayCompleted = GiveawayCompleted::fromArray($data);

        $this->assertInstanceOf(GiveawayCompleted::class, $giveawayCompleted);
        $this->assertInstanceOf(Message::class, $giveawayCompleted->giveaway_message);
        $this->assertSame(5, $giveawayCompleted->winner_count);
        $this->assertSame(2, $giveawayCompleted->unclaimed_prize_count);
        $this->assertSame(false, $giveawayCompleted->is_star_giveaway);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('giveaway_completed_minimal.json');
        $giveawayCompleted = GiveawayCompleted::fromArray($data);

        $this->assertInstanceOf(GiveawayCompleted::class, $giveawayCompleted);
        $this->assertNull($giveawayCompleted->unclaimed_prize_count);
        $this->assertNull($giveawayCompleted->giveaway_message);
        $this->assertNull($giveawayCompleted->is_star_giveaway);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('giveaway_completed_minimal.json');
        $giveawayCompleted = GiveawayCompleted::fromArray($data);
        $this->assertEquals($data, $giveawayCompleted->toArray());
    }
}
