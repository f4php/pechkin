<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\SuggestedPostPrice;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SuggestedPostPriceTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('suggested_post_price_full.json');
        $suggestedPostPrice = SuggestedPostPrice::fromArray($data);

        $this->assertInstanceOf(SuggestedPostPrice::class, $suggestedPostPrice);
        $this->assertSame('USD', $suggestedPostPrice->currency);
        $this->assertSame(1000, $suggestedPostPrice->amount);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('suggested_post_price_minimal.json');
        $suggestedPostPrice = SuggestedPostPrice::fromArray($data);
        $this->assertEquals($data, $suggestedPostPrice->toArray());
    }
}
