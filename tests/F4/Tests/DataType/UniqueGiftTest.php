<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\UniqueGift;
use F4\Pechkin\DataType\UniqueGiftBackdrop;
use F4\Pechkin\DataType\UniqueGiftColors;
use F4\Pechkin\DataType\UniqueGiftModel;
use F4\Pechkin\DataType\UniqueGiftSymbol;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UniqueGiftTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('unique_gift_full.json');
        $uniqueGift = UniqueGift::fromArray($data);

        $this->assertInstanceOf(UniqueGift::class, $uniqueGift);
        $this->assertInstanceOf(UniqueGiftModel::class, $uniqueGift->model);
        $this->assertInstanceOf(UniqueGiftSymbol::class, $uniqueGift->symbol);
        $this->assertInstanceOf(UniqueGiftBackdrop::class, $uniqueGift->backdrop);
        $this->assertInstanceOf(UniqueGiftColors::class, $uniqueGift->colors);
        $this->assertInstanceOf(Chat::class, $uniqueGift->publisher_chat);
        $this->assertSame('test_string', $uniqueGift->gift_id);
        $this->assertSame('gift_base', $uniqueGift->base_name);
        $this->assertSame('Test Name', $uniqueGift->name);
        $this->assertSame(42, $uniqueGift->number);
        $this->assertSame(true, $uniqueGift->is_premium);
        $this->assertSame(true, $uniqueGift->is_from_blockchain);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('unique_gift_minimal.json');
        $uniqueGift = UniqueGift::fromArray($data);

        $this->assertInstanceOf(UniqueGift::class, $uniqueGift);
        $this->assertNull($uniqueGift->is_premium);
        $this->assertNull($uniqueGift->is_from_blockchain);
        $this->assertNull($uniqueGift->colors);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('unique_gift_minimal.json');
        $uniqueGift = UniqueGift::fromArray($data);
        $this->assertEquals($data, $uniqueGift->toArray());
    }
}
