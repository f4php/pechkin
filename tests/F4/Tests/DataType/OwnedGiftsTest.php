<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\OwnedGifts;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class OwnedGiftsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('owned_gifts_full.json');
        $ownedGifts = OwnedGifts::fromArray($data);

        $this->assertInstanceOf(OwnedGifts::class, $ownedGifts);
        $this->assertNotEmpty($ownedGifts->gifts);
        $this->assertSame('10', $ownedGifts->next_offset);
        $this->assertSame(10, $ownedGifts->total_count);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('owned_gifts_minimal.json');
        $ownedGifts = OwnedGifts::fromArray($data);

        $this->assertInstanceOf(OwnedGifts::class, $ownedGifts);
        $this->assertNull($ownedGifts->next_offset);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('owned_gifts_minimal.json');
        $ownedGifts = OwnedGifts::fromArray($data);
        $this->assertEquals($data, $ownedGifts->toArray());
    }
}
