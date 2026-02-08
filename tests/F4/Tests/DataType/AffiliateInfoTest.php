<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\AffiliateInfo;
use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class AffiliateInfoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('affiliate_info_full.json');
        $affiliateInfo = AffiliateInfo::fromArray($data);

        $this->assertInstanceOf(AffiliateInfo::class, $affiliateInfo);
        $this->assertInstanceOf(User::class, $affiliateInfo->affiliate_user);
        $this->assertInstanceOf(Chat::class, $affiliateInfo->affiliate_chat);
        $this->assertSame(1000, $affiliateInfo->amount);
        $this->assertSame(50, $affiliateInfo->commission_per_mille);
        $this->assertSame(500, $affiliateInfo->nanostar_amount);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('affiliate_info_minimal.json');
        $affiliateInfo = AffiliateInfo::fromArray($data);

        $this->assertInstanceOf(AffiliateInfo::class, $affiliateInfo);
        $this->assertNull($affiliateInfo->affiliate_user);
        $this->assertNull($affiliateInfo->affiliate_chat);
        $this->assertNull($affiliateInfo->nanostar_amount);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('affiliate_info_minimal.json');
        $affiliateInfo = AffiliateInfo::fromArray($data);
        $this->assertEquals($data, $affiliateInfo->toArray());
    }
}
