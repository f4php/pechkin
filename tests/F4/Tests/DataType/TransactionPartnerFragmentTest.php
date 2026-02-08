<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RevenueWithdrawalState;
use F4\Pechkin\DataType\TransactionPartnerFragment;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class TransactionPartnerFragmentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('transaction_partner_fragment_full.json');
        $transactionPartnerFragment = TransactionPartnerFragment::fromArray($data);

        $this->assertInstanceOf(TransactionPartnerFragment::class, $transactionPartnerFragment);
        $this->assertNotNull($transactionPartnerFragment->withdrawal_state);
        $this->assertInstanceOf(RevenueWithdrawalState::class, $transactionPartnerFragment->withdrawal_state);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('transaction_partner_fragment_minimal.json');
        $transactionPartnerFragment = TransactionPartnerFragment::fromArray($data);

        $this->assertInstanceOf(TransactionPartnerFragment::class, $transactionPartnerFragment);
        $this->assertNull($transactionPartnerFragment->withdrawal_state);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('transaction_partner_fragment_minimal.json');
        $transactionPartnerFragment = TransactionPartnerFragment::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'fragment'], $transactionPartnerFragment->toArray());
    }
}
