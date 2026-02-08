<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\LabeledPrice;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class LabeledPriceTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('labeled_price_full.json');
        $labeledPrice = LabeledPrice::fromArray($data);

        $this->assertInstanceOf(LabeledPrice::class, $labeledPrice);
        $this->assertSame('test_string', $labeledPrice->label);
        $this->assertSame(1000, $labeledPrice->amount);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('labeled_price_minimal.json');
        $labeledPrice = LabeledPrice::fromArray($data);
        $this->assertEquals($data, $labeledPrice->toArray());
    }
}
