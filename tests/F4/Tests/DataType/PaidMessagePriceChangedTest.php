<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PaidMessagePriceChanged;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PaidMessagePriceChangedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('paid_message_price_changed_full.json');
        $paidMessagePriceChanged = PaidMessagePriceChanged::fromArray($data);

        $this->assertInstanceOf(PaidMessagePriceChanged::class, $paidMessagePriceChanged);
        $this->assertSame(10, $paidMessagePriceChanged->paid_message_star_count);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('paid_message_price_changed_minimal.json');
        $paidMessagePriceChanged = PaidMessagePriceChanged::fromArray($data);
        $this->assertEquals($data, $paidMessagePriceChanged->toArray());
    }
}
