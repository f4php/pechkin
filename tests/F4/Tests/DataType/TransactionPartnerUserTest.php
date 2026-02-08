<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\AffiliateInfo;
use F4\Pechkin\DataType\Gift;
use F4\Pechkin\DataType\TransactionPartnerUser;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class TransactionPartnerUserTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('transaction_partner_user_full.json');
        $transactionPartnerUser = TransactionPartnerUser::fromArray($data);

        $this->assertInstanceOf(TransactionPartnerUser::class, $transactionPartnerUser);
        $this->assertInstanceOf(User::class, $transactionPartnerUser->user);
        $this->assertInstanceOf(AffiliateInfo::class, $transactionPartnerUser->affiliate);
        $this->assertNotEmpty($transactionPartnerUser->paid_media);
        $this->assertInstanceOf(Gift::class, $transactionPartnerUser->gift);
        $this->assertSame('test_string', $transactionPartnerUser->transaction_type);
        $this->assertSame('test_payload', $transactionPartnerUser->invoice_payload);
        $this->assertSame(2592000, $transactionPartnerUser->subscription_period);
        $this->assertSame('test_string', $transactionPartnerUser->paid_media_payload);
        $this->assertSame(42, $transactionPartnerUser->premium_subscription_duration);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('transaction_partner_user_minimal.json');
        $transactionPartnerUser = TransactionPartnerUser::fromArray($data);

        $this->assertInstanceOf(TransactionPartnerUser::class, $transactionPartnerUser);
        $this->assertNull($transactionPartnerUser->affiliate);
        $this->assertNull($transactionPartnerUser->invoice_payload);
        $this->assertNull($transactionPartnerUser->subscription_period);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('transaction_partner_user_minimal.json');
        $transactionPartnerUser = TransactionPartnerUser::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'user'], $transactionPartnerUser->toArray());
    }
}
