<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\UniqueGift;
use F4\Pechkin\DataType\UniqueGiftInfo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UniqueGiftInfoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('unique_gift_info_full.json');
        $uniqueGiftInfo = UniqueGiftInfo::fromArray($data);

        $this->assertInstanceOf(UniqueGiftInfo::class, $uniqueGiftInfo);
        $this->assertInstanceOf(UniqueGift::class, $uniqueGiftInfo->unique_gift);
        $this->assertSame('upgrade', $uniqueGiftInfo->origin);
        $this->assertSame('test_string', $uniqueGiftInfo->last_resale_currency);
        $this->assertSame(42, $uniqueGiftInfo->last_resale_amount);
        $this->assertSame('test_string', $uniqueGiftInfo->owned_gift_id);
        $this->assertSame(100, $uniqueGiftInfo->transfer_star_count);
        $this->assertSame(42, $uniqueGiftInfo->next_transfer_date);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('unique_gift_info_minimal.json');
        $uniqueGiftInfo = UniqueGiftInfo::fromArray($data);

        $this->assertInstanceOf(UniqueGiftInfo::class, $uniqueGiftInfo);
        $this->assertNull($uniqueGiftInfo->last_resale_currency);
        $this->assertNull($uniqueGiftInfo->last_resale_amount);
        $this->assertNull($uniqueGiftInfo->owned_gift_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('unique_gift_info_minimal.json');
        $uniqueGiftInfo = UniqueGiftInfo::fromArray($data);
        $this->assertEquals($data, $uniqueGiftInfo->toArray());
    }
}
