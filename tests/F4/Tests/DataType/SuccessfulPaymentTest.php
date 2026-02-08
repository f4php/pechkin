<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\OrderInfo;
use F4\Pechkin\DataType\SuccessfulPayment;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SuccessfulPaymentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('successful_payment_full.json');
        $successfulPayment = SuccessfulPayment::fromArray($data);

        $this->assertInstanceOf(SuccessfulPayment::class, $successfulPayment);
        $this->assertInstanceOf(OrderInfo::class, $successfulPayment->order_info);
        $this->assertSame('USD', $successfulPayment->currency);
        $this->assertSame(10000, $successfulPayment->total_amount);
        $this->assertSame('test_payload', $successfulPayment->invoice_payload);
        $this->assertSame('charge_123', $successfulPayment->telegram_payment_charge_id);
        $this->assertSame('provider_charge_456', $successfulPayment->provider_payment_charge_id);
        $this->assertSame(42, $successfulPayment->subscription_expiration_date);
        $this->assertSame(true, $successfulPayment->is_recurring);
        $this->assertSame(true, $successfulPayment->is_first_recurring);
        $this->assertSame('shipping_1', $successfulPayment->shipping_option_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('successful_payment_minimal.json');
        $successfulPayment = SuccessfulPayment::fromArray($data);

        $this->assertInstanceOf(SuccessfulPayment::class, $successfulPayment);
        $this->assertNull($successfulPayment->subscription_expiration_date);
        $this->assertNull($successfulPayment->is_recurring);
        $this->assertNull($successfulPayment->is_first_recurring);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('successful_payment_minimal.json');
        $successfulPayment = SuccessfulPayment::fromArray($data);
        $this->assertEquals($data, $successfulPayment->toArray());
    }
}
