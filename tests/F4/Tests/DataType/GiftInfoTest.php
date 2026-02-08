<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Gift;
use F4\Pechkin\DataType\GiftInfo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class GiftInfoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('gift_info_full.json');
        $giftInfo = GiftInfo::fromArray($data);

        $this->assertInstanceOf(GiftInfo::class, $giftInfo);
        $this->assertInstanceOf(Gift::class, $giftInfo->gift);
        $this->assertNotEmpty($giftInfo->entities);
        $this->assertSame(25, $giftInfo->prepaid_upgrade_star_count);
        $this->assertSame('test_string', $giftInfo->owned_gift_id);
        $this->assertSame(42, $giftInfo->convert_star_count);
        $this->assertSame(true, $giftInfo->is_upgrade_separate);
        $this->assertSame(true, $giftInfo->can_be_upgraded);
        $this->assertSame('Hello, World!', $giftInfo->text);
        $this->assertSame(true, $giftInfo->is_private);
        $this->assertSame(42, $giftInfo->unique_gift_number);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('gift_info_minimal.json');
        $giftInfo = GiftInfo::fromArray($data);

        $this->assertInstanceOf(GiftInfo::class, $giftInfo);
        $this->assertNull($giftInfo->prepaid_upgrade_star_count);
        $this->assertNull($giftInfo->owned_gift_id);
        $this->assertNull($giftInfo->convert_star_count);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('gift_info_minimal.json');
        $giftInfo = GiftInfo::fromArray($data);
        $this->assertEquals($data, $giftInfo->toArray());
    }
}
