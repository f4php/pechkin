<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Birthdate;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BirthdateTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('birthdate_full.json');
        $birthdate = Birthdate::fromArray($data);

        $this->assertInstanceOf(Birthdate::class, $birthdate);
        $this->assertSame(15, $birthdate->day);
        $this->assertSame(6, $birthdate->month);
        $this->assertSame(1990, $birthdate->year);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('birthdate_minimal.json');
        $birthdate = Birthdate::fromArray($data);

        $this->assertInstanceOf(Birthdate::class, $birthdate);
        $this->assertNull($birthdate->year);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('birthdate_minimal.json');
        $birthdate = Birthdate::fromArray($data);
        $this->assertEquals($data, $birthdate->toArray());
    }
}
