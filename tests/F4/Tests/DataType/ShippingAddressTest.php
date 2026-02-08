<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ShippingAddress;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ShippingAddressTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('shipping_address_full.json');
        $shippingAddress = ShippingAddress::fromArray($data);

        $this->assertInstanceOf(ShippingAddress::class, $shippingAddress);
        $this->assertSame('US', $shippingAddress->country_code);
        $this->assertSame('California', $shippingAddress->state);
        $this->assertSame('San Francisco', $shippingAddress->city);
        $this->assertSame('123 Main St', $shippingAddress->street_line1);
        $this->assertSame('Apt 4', $shippingAddress->street_line2);
        $this->assertSame('94105', $shippingAddress->post_code);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('shipping_address_minimal.json');
        $shippingAddress = ShippingAddress::fromArray($data);
        $this->assertEquals($data, $shippingAddress->toArray());
    }
}
