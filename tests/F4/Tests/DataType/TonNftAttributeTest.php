<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\TonNftAttribute;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class TonNftAttributeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('ton_nft_attribute_full.json');
        $tonNftAttribute = TonNftAttribute::fromArray($data);

        $this->assertInstanceOf(TonNftAttribute::class, $tonNftAttribute);
        $this->assertSame('Background', $tonNftAttribute->trait_type);
        $this->assertSame('Blue', $tonNftAttribute->value);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('ton_nft_attribute_minimal.json');
        $tonNftAttribute = TonNftAttribute::fromArray($data);

        $this->assertInstanceOf(TonNftAttribute::class, $tonNftAttribute);
        $this->assertSame('Background', $tonNftAttribute->trait_type);
        $this->assertSame('Blue', $tonNftAttribute->value);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('ton_nft_attribute_minimal.json');
        $tonNftAttribute = TonNftAttribute::fromArray($data);
        $this->assertEquals($data, $tonNftAttribute->toArray());
    }
}
