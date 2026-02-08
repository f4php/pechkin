<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\GiveawayCreated;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class GiveawayCreatedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('giveaway_created_full.json');
        $giveawayCreated = GiveawayCreated::fromArray($data);

        $this->assertInstanceOf(GiveawayCreated::class, $giveawayCreated);
        $this->assertSame(100, $giveawayCreated->prize_star_count);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('giveaway_created_minimal.json');
        $giveawayCreated = GiveawayCreated::fromArray($data);

        $this->assertInstanceOf(GiveawayCreated::class, $giveawayCreated);
        $this->assertNull($giveawayCreated->prize_star_count);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('giveaway_created_minimal.json');
        $giveawayCreated = GiveawayCreated::fromArray($data);
        $this->assertEquals($data, $giveawayCreated->toArray());
    }
}
