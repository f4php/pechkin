<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\TransactionPartnerTelegramAds;
use PHPUnit\Framework\TestCase;

final class TransactionPartnerTelegramAdsTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $transactionPartnerTelegramAds = TransactionPartnerTelegramAds::fromArray($data);
        $this->assertInstanceOf(TransactionPartnerTelegramAds::class, $transactionPartnerTelegramAds);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $transactionPartnerTelegramAds = TransactionPartnerTelegramAds::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'telegram_ads'], $transactionPartnerTelegramAds->toArray());
    }
}
