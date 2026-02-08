<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\UniqueGiftBackdrop;
use F4\Pechkin\DataType\UniqueGiftBackdropColors;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UniqueGiftBackdropTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('unique_gift_backdrop_full.json');
        $uniqueGiftBackdrop = UniqueGiftBackdrop::fromArray($data);

        $this->assertInstanceOf(UniqueGiftBackdrop::class, $uniqueGiftBackdrop);
        $this->assertInstanceOf(UniqueGiftBackdropColors::class, $uniqueGiftBackdrop->colors);
        $this->assertSame('Test Name', $uniqueGiftBackdrop->name);
        $this->assertSame(42, $uniqueGiftBackdrop->rarity_per_mille);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('unique_gift_backdrop_minimal.json');
        $uniqueGiftBackdrop = UniqueGiftBackdrop::fromArray($data);
        $this->assertEquals($data, $uniqueGiftBackdrop->toArray());
    }
}
