<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\OrderInfo;
use F4\Pechkin\DataType\PreCheckoutQuery;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PreCheckoutQueryTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('pre_checkout_query_full.json');
        $preCheckoutQuery = PreCheckoutQuery::fromArray($data);

        $this->assertInstanceOf(PreCheckoutQuery::class, $preCheckoutQuery);
        $this->assertInstanceOf(User::class, $preCheckoutQuery->from);
        $this->assertInstanceOf(OrderInfo::class, $preCheckoutQuery->order_info);
        $this->assertSame('123456789', $preCheckoutQuery->id);
        $this->assertSame('USD', $preCheckoutQuery->currency);
        $this->assertSame(10000, $preCheckoutQuery->total_amount);
        $this->assertSame('test_payload', $preCheckoutQuery->invoice_payload);
        $this->assertSame('shipping_1', $preCheckoutQuery->shipping_option_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('pre_checkout_query_minimal.json');
        $preCheckoutQuery = PreCheckoutQuery::fromArray($data);

        $this->assertInstanceOf(PreCheckoutQuery::class, $preCheckoutQuery);
        $this->assertNull($preCheckoutQuery->shipping_option_id);
        $this->assertNull($preCheckoutQuery->order_info);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('pre_checkout_query_minimal.json');
        $preCheckoutQuery = PreCheckoutQuery::fromArray($data);
        $this->assertEquals($data, $preCheckoutQuery->toArray());
    }
}
