<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\OrderInfo;
use F4\Pechkin\DataType\ShippingAddress;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class OrderInfoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('order_info_full.json');
        $orderInfo = OrderInfo::fromArray($data);

        $this->assertInstanceOf(OrderInfo::class, $orderInfo);
        $this->assertInstanceOf(ShippingAddress::class, $orderInfo->shipping_address);
        $this->assertSame('Test Name', $orderInfo->name);
        $this->assertSame('+1234567890', $orderInfo->phone_number);
        $this->assertSame('test@example.com', $orderInfo->email);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('order_info_minimal.json');
        $orderInfo = OrderInfo::fromArray($data);

        $this->assertInstanceOf(OrderInfo::class, $orderInfo);
        $this->assertNull($orderInfo->name);
        $this->assertNull($orderInfo->phone_number);
        $this->assertNull($orderInfo->email);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('order_info_minimal.json');
        $orderInfo = OrderInfo::fromArray($data);
        $this->assertEquals($data, $orderInfo->toArray());
    }
}
