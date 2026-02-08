<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\OwnedGiftUnique;
use F4\Pechkin\DataType\UniqueGift;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class OwnedGiftUniqueTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('owned_gift_unique_full.json');
        $ownedGiftUnique = OwnedGiftUnique::fromArray($data);

        $this->assertInstanceOf(OwnedGiftUnique::class, $ownedGiftUnique);
        $this->assertInstanceOf(UniqueGift::class, $ownedGiftUnique->gift);
        $this->assertInstanceOf(User::class, $ownedGiftUnique->sender_user);
        $this->assertSame(1700000000, $ownedGiftUnique->send_date);
        $this->assertSame('test_string', $ownedGiftUnique->owned_gift_id);
        $this->assertSame(true, $ownedGiftUnique->is_saved);
        $this->assertSame(true, $ownedGiftUnique->can_be_transferred);
        $this->assertSame(100, $ownedGiftUnique->transfer_star_count);
        $this->assertSame(42, $ownedGiftUnique->next_transfer_date);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('owned_gift_unique_minimal.json');
        $ownedGiftUnique = OwnedGiftUnique::fromArray($data);

        $this->assertInstanceOf(OwnedGiftUnique::class, $ownedGiftUnique);
        $this->assertNull($ownedGiftUnique->owned_gift_id);
        $this->assertNull($ownedGiftUnique->sender_user);
        $this->assertNull($ownedGiftUnique->is_saved);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('owned_gift_unique_minimal.json');
        $ownedGiftUnique = OwnedGiftUnique::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'unique'], $ownedGiftUnique->toArray());
    }
}
