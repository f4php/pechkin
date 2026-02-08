<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\TransactionPartner;
use F4\Pechkin\DataType\TransactionPartnerUser;
use F4\Pechkin\DataType\TransactionPartnerChat;
use F4\Pechkin\DataType\TransactionPartnerAffiliateProgram;
use F4\Pechkin\DataType\TransactionPartnerFragment;
use F4\Pechkin\DataType\TransactionPartnerTelegramAds;
use F4\Pechkin\DataType\TransactionPartnerTelegramApi;
use F4\Pechkin\DataType\TransactionPartnerOther;

final class TransactionPartnerTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithUserType(): void
    {
        $data = [
            ...$this->loadFixture('transaction_partner_user_full.json'),
            'type' => 'user',
        ];
        $result = TransactionPartner::fromArray($data);
        $this->assertInstanceOf(TransactionPartnerUser::class, $result);
    }

    public function testFromArrayWithChatType(): void
    {
        $data = [
            ...$this->loadFixture('transaction_partner_chat_full.json'),
            'type' => 'chat'
        ];
        $result = TransactionPartner::fromArray($data);
        $this->assertInstanceOf(TransactionPartnerChat::class, $result);
    }

    public function testFromArrayWithAffiliateProgramType(): void
    {
        $data = [
            ...$this->loadFixture('transaction_partner_affiliate_program_full.json'),
            'type' => 'affiliate_program',
        ];
        $result = TransactionPartner::fromArray($data);
        $this->assertInstanceOf(TransactionPartnerAffiliateProgram::class, $result);
    }

    public function testFromArrayWithFragmentType(): void
    {
        $data = [
            ...$this->loadFixture('transaction_partner_fragment_full.json'),
            'type' => 'fragment',
        ];
        $result = TransactionPartner::fromArray($data);
        $this->assertInstanceOf(TransactionPartnerFragment::class, $result);
    }

    public function testFromArrayWithTelegramAdsType(): void
    {
        $data = [
            'type' => 'telegram_ads',
        ];
        $result = TransactionPartner::fromArray($data);
        $this->assertInstanceOf(TransactionPartnerTelegramAds::class, $result);
    }

    public function testFromArrayWithTelegramApiType(): void
    {
        $data = [
            ...$this->loadFixture('transaction_partner_telegram_api_full.json'),
            'type' => 'telegram_api',
        ];
        $result = TransactionPartner::fromArray($data);
        $this->assertInstanceOf(TransactionPartnerTelegramApi::class, $result);
    }

    public function testFromArrayWithOtherType(): void
    {
        $data = [
            'type' => 'other',
        ];
        $result = TransactionPartner::fromArray($data);
        $this->assertInstanceOf(TransactionPartnerOther::class, $result);
    }
}
