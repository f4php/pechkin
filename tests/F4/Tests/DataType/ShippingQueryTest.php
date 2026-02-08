<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ShippingAddress;
use F4\Pechkin\DataType\ShippingQuery;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ShippingQueryTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('shipping_query_full.json');
        $shippingQuery = ShippingQuery::fromArray($data);

        $this->assertInstanceOf(ShippingQuery::class, $shippingQuery);
        $this->assertInstanceOf(User::class, $shippingQuery->from);
        $this->assertInstanceOf(ShippingAddress::class, $shippingQuery->shipping_address);
        $this->assertSame('123456789', $shippingQuery->id);
        $this->assertSame('test_payload', $shippingQuery->invoice_payload);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('shipping_query_minimal.json');
        $shippingQuery = ShippingQuery::fromArray($data);
        $this->assertEquals($data, $shippingQuery->toArray());
    }
}
