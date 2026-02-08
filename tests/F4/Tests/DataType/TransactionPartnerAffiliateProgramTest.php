<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\TransactionPartnerAffiliateProgram;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class TransactionPartnerAffiliateProgramTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('transaction_partner_affiliate_program_full.json');
        $transactionPartnerAffiliateProgram = TransactionPartnerAffiliateProgram::fromArray($data);

        $this->assertInstanceOf(TransactionPartnerAffiliateProgram::class, $transactionPartnerAffiliateProgram);
        $this->assertInstanceOf(User::class, $transactionPartnerAffiliateProgram->sponsor_user);
        $this->assertSame(50, $transactionPartnerAffiliateProgram->commission_per_mille);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('transaction_partner_affiliate_program_minimal.json');
        $transactionPartnerAffiliateProgram = TransactionPartnerAffiliateProgram::fromArray($data);

        $this->assertInstanceOf(TransactionPartnerAffiliateProgram::class, $transactionPartnerAffiliateProgram);
        $this->assertNull($transactionPartnerAffiliateProgram->sponsor_user);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('transaction_partner_affiliate_program_minimal.json');
        $transactionPartnerAffiliateProgram = TransactionPartnerAffiliateProgram::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'affiliate_program'], $transactionPartnerAffiliateProgram->toArray());
    }
}
