<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\TonNft;
use F4\Pechkin\DataType\TonNftAttribute;
use F4\Pechkin\DataType\UniqueGift;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class TonNftTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('ton_nft_full.json');
        $tonNft = TonNft::fromArray($data);

        $this->assertInstanceOf(TonNft::class, $tonNft);
        $this->assertSame('EQBnft0000000000000000000000000000000000000000001', $tonNft->address);
        $this->assertSame('EQCcollection00000000000000000000000000000000001', $tonNft->collection_address);
        $this->assertSame('18446744073709551617', $tonNft->index);
        $this->assertSame('Test NFT', $tonNft->name);
        $this->assertSame('Test NFT description', $tonNft->description);
        $this->assertCount(1, $tonNft->attributes);
        $this->assertInstanceOf(TonNftAttribute::class, $tonNft->attributes[0]);
        $this->assertSame('Blue', $tonNft->attributes[0]->value);
        $this->assertInstanceOf(UniqueGift::class, $tonNft->gift);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('ton_nft_minimal.json');
        $tonNft = TonNft::fromArray($data);

        $this->assertInstanceOf(TonNft::class, $tonNft);
        $this->assertSame('18446744073709551617', $tonNft->index);
        $this->assertNull($tonNft->collection_address);
        $this->assertNull($tonNft->attributes);
        $this->assertNull($tonNft->gift);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('ton_nft_minimal.json');
        $tonNft = TonNft::fromArray($data);
        $this->assertEquals($data, $tonNft->toArray());
    }
}
