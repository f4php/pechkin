<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\StarAmount;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StarAmountTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('star_amount_full.json');
        $starAmount = StarAmount::fromArray($data);

        $this->assertInstanceOf(StarAmount::class, $starAmount);
        $this->assertSame(1000, $starAmount->amount);
        $this->assertSame(500, $starAmount->nanostar_amount);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('star_amount_minimal.json');
        $starAmount = StarAmount::fromArray($data);

        $this->assertInstanceOf(StarAmount::class, $starAmount);
        $this->assertNull($starAmount->nanostar_amount);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('star_amount_minimal.json');
        $starAmount = StarAmount::fromArray($data);
        $this->assertEquals($data, $starAmount->toArray());
    }
}
