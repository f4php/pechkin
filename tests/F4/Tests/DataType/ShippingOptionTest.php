<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ShippingOption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ShippingOptionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('shipping_option_full.json');
        $shippingOption = ShippingOption::fromArray($data);

        $this->assertInstanceOf(ShippingOption::class, $shippingOption);
        $this->assertNotEmpty($shippingOption->prices);
        $this->assertSame('123456789', $shippingOption->id);
        $this->assertSame('Test Title', $shippingOption->title);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('shipping_option_minimal.json');
        $shippingOption = ShippingOption::fromArray($data);
        $this->assertEquals($data, $shippingOption->toArray());
    }
}
