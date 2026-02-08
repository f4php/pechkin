<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RevenueWithdrawalStatePending;
use PHPUnit\Framework\TestCase;

final class RevenueWithdrawalStatePendingTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $revenueWithdrawalStatePending = RevenueWithdrawalStatePending::fromArray($data);

        $this->assertInstanceOf(RevenueWithdrawalStatePending::class, $revenueWithdrawalStatePending);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $revenueWithdrawalStatePending = RevenueWithdrawalStatePending::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'pending'], $revenueWithdrawalStatePending->toArray());
    }
}
