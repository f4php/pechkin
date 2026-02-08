<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\TransactionPartnerTelegramApi;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class TransactionPartnerTelegramApiTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('transaction_partner_telegram_api_full.json');
        $transactionPartnerTelegramApi = TransactionPartnerTelegramApi::fromArray($data);

        $this->assertInstanceOf(TransactionPartnerTelegramApi::class, $transactionPartnerTelegramApi);
        $this->assertSame(10, $transactionPartnerTelegramApi->request_count);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('transaction_partner_telegram_api_minimal.json');
        $transactionPartnerTelegramApi = TransactionPartnerTelegramApi::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'telegram_api'], $transactionPartnerTelegramApi->toArray());
    }
}
