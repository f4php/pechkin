<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Dice;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class DiceTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('dice_full.json');
        $dice = Dice::fromArray($data);

        $this->assertInstanceOf(Dice::class, $dice);
        $this->assertSame('🎲', $dice->emoji);
        $this->assertSame(6, $dice->value);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('dice_minimal.json');
        $dice = Dice::fromArray($data);
        $this->assertEquals($data, $dice->toArray());
    }
}
