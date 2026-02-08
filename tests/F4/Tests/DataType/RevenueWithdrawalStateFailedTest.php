<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RevenueWithdrawalStateFailed;
use PHPUnit\Framework\TestCase;

final class RevenueWithdrawalStateFailedTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $revenueWithdrawalStateFailed = RevenueWithdrawalStateFailed::fromArray($data);
        $this->assertInstanceOf(RevenueWithdrawalStateFailed::class, $revenueWithdrawalStateFailed);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $revenueWithdrawalStateFailed = RevenueWithdrawalStateFailed::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'failed'], $revenueWithdrawalStateFailed->toArray());
    }
}
