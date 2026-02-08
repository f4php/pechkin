<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RefundedPayment;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RefundedPaymentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('refunded_payment_full.json');
        $refundedPayment = RefundedPayment::fromArray($data);

        $this->assertInstanceOf(RefundedPayment::class, $refundedPayment);
        $this->assertSame('USD', $refundedPayment->currency);
        $this->assertSame(10000, $refundedPayment->total_amount);
        $this->assertSame('test_payload', $refundedPayment->invoice_payload);
        $this->assertSame('charge_123', $refundedPayment->telegram_payment_charge_id);
        $this->assertSame('provider_charge_456', $refundedPayment->provider_payment_charge_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('refunded_payment_minimal.json');
        $refundedPayment = RefundedPayment::fromArray($data);

        $this->assertInstanceOf(RefundedPayment::class, $refundedPayment);
        $this->assertNull($refundedPayment->provider_payment_charge_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('refunded_payment_minimal.json');
        $refundedPayment = RefundedPayment::fromArray($data);
        $this->assertEquals($data, $refundedPayment->toArray());
    }
}
