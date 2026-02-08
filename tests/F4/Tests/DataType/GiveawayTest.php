<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Giveaway;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class GiveawayTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('giveaway_full.json');
        $giveaway = Giveaway::fromArray($data);

        $this->assertInstanceOf(Giveaway::class, $giveaway);
        $this->assertNotEmpty($giveaway->chats);
        $this->assertNotEmpty($giveaway->country_codes);
        $this->assertSame(42, $giveaway->winners_selection_date);
        $this->assertSame(5, $giveaway->winner_count);
        $this->assertSame(false, $giveaway->only_new_members);
        $this->assertSame(true, $giveaway->has_public_winners);
        $this->assertSame('Win a prize!', $giveaway->prize_description);
        $this->assertSame(100, $giveaway->prize_star_count);
        $this->assertSame(42, $giveaway->premium_subscription_month_count);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('giveaway_minimal.json');
        $giveaway = Giveaway::fromArray($data);

        $this->assertInstanceOf(Giveaway::class, $giveaway);
        $this->assertNull($giveaway->only_new_members);
        $this->assertNull($giveaway->has_public_winners);
        $this->assertNull($giveaway->prize_description);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('giveaway_minimal.json');
        $giveaway = Giveaway::fromArray($data);
        $this->assertEquals($data, $giveaway->toArray());
    }
}
