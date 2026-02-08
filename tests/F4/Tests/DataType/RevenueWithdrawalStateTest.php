<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\RevenueWithdrawalState;
use F4\Pechkin\DataType\RevenueWithdrawalStatePending;
use F4\Pechkin\DataType\RevenueWithdrawalStateSucceeded;
use F4\Pechkin\DataType\RevenueWithdrawalStateFailed;

final class RevenueWithdrawalStateTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithPendingType(): void
    {
        $data = [
            'type' => 'pending',
        ];
        $result = RevenueWithdrawalState::fromArray($data);
        $this->assertInstanceOf(RevenueWithdrawalStatePending::class, $result);
    }

    public function testFromArrayWithSucceededType(): void
    {
        $data = [
            ...$this->loadFixture('revenue_withdrawal_state_succeeded_full.json'),
            'type' => 'succeeded',
        ];
        $result = RevenueWithdrawalState::fromArray($data);
        $this->assertInstanceOf(RevenueWithdrawalStateSucceeded::class, $result);
    }

    public function testFromArrayWithFailedType(): void
    {
        $data = [
            'type' => 'failed',
        ];
        $result = RevenueWithdrawalState::fromArray($data);
        $this->assertInstanceOf(RevenueWithdrawalStateFailed::class, $result);
    }

}
