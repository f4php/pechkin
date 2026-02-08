<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Gift;
use F4\Pechkin\DataType\OwnedGiftRegular;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class OwnedGiftRegularTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('owned_gift_regular_full.json');
        $ownedGiftRegular = OwnedGiftRegular::fromArray($data);

        $this->assertInstanceOf(OwnedGiftRegular::class, $ownedGiftRegular);
        $this->assertInstanceOf(Gift::class, $ownedGiftRegular->gift);
        $this->assertInstanceOf(User::class, $ownedGiftRegular->sender_user);
        $this->assertNotEmpty($ownedGiftRegular->entities);
        $this->assertSame(1700000000, $ownedGiftRegular->send_date);
        $this->assertSame(true, $ownedGiftRegular->is_upgrade_separate);
        $this->assertSame(42, $ownedGiftRegular->unique_gift_number);
        $this->assertSame('test_string', $ownedGiftRegular->owned_gift_id);
        $this->assertSame('Hello, World!', $ownedGiftRegular->text);
        $this->assertSame(true, $ownedGiftRegular->is_private);
        $this->assertSame(true, $ownedGiftRegular->is_saved);
        $this->assertSame(true, $ownedGiftRegular->can_be_upgraded);
        $this->assertSame(false, $ownedGiftRegular->was_refunded);
        $this->assertSame(42, $ownedGiftRegular->convert_star_count);
        $this->assertSame(25, $ownedGiftRegular->prepaid_upgrade_star_count);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('owned_gift_regular_minimal.json');
        $ownedGiftRegular = OwnedGiftRegular::fromArray($data);

        $this->assertInstanceOf(OwnedGiftRegular::class, $ownedGiftRegular);
        $this->assertNull($ownedGiftRegular->is_upgrade_separate);
        $this->assertNull($ownedGiftRegular->unique_gift_number);
        $this->assertNull($ownedGiftRegular->owned_gift_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('owned_gift_regular_minimal.json');
        $ownedGiftRegular = OwnedGiftRegular::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'regular'], $ownedGiftRegular->toArray());
    }
}
