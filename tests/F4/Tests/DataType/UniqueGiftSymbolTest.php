<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Sticker;
use F4\Pechkin\DataType\UniqueGiftSymbol;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UniqueGiftSymbolTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('unique_gift_symbol_full.json');
        $uniqueGiftSymbol = UniqueGiftSymbol::fromArray($data);

        $this->assertInstanceOf(UniqueGiftSymbol::class, $uniqueGiftSymbol);
        $this->assertInstanceOf(Sticker::class, $uniqueGiftSymbol->sticker);
        $this->assertSame('Test Name', $uniqueGiftSymbol->name);
        $this->assertSame(42, $uniqueGiftSymbol->rarity_per_mille);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('unique_gift_symbol_minimal.json');
        $uniqueGiftSymbol = UniqueGiftSymbol::fromArray($data);
        $this->assertEquals($data, $uniqueGiftSymbol->toArray());
    }
}
