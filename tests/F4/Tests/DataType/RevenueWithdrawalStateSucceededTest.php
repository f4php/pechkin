<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RevenueWithdrawalStateSucceeded;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RevenueWithdrawalStateSucceededTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('revenue_withdrawal_state_succeeded_full.json');
        $revenueWithdrawalStateSucceeded = RevenueWithdrawalStateSucceeded::fromArray($data);

        $this->assertInstanceOf(RevenueWithdrawalStateSucceeded::class, $revenueWithdrawalStateSucceeded);
        $this->assertSame(1700000000, $revenueWithdrawalStateSucceeded->date);
        $this->assertSame('https://example.com', $revenueWithdrawalStateSucceeded->url);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('revenue_withdrawal_state_succeeded_minimal.json');
        $revenueWithdrawalStateSucceeded = RevenueWithdrawalStateSucceeded::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'succeeded'], $revenueWithdrawalStateSucceeded->toArray());
    }
}
