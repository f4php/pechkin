<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\Birthdate;

final class BirthdateTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'day' => 15,
            'month' => 6,
            'year' => 1990,
        ];
        $birthdate = Birthdate::fromArray($data);

        $this->assertSame(15, $birthdate->day);
        $this->assertSame(6, $birthdate->month);
        $this->assertSame(1990, $birthdate->year);
    }

    public function testFromArrayWithoutYear(): void
    {
        $data = [
            'day' => 25,
            'month' => 12,
        ];
        $birthdate = Birthdate::fromArray($data);

        $this->assertSame(25, $birthdate->day);
        $this->assertSame(12, $birthdate->month);
        $this->assertNull($birthdate->year);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'day' => 15,
            'month' => 6,
            'year' => 1990,
        ];
        $birthdate = Birthdate::fromArray($data);

        $this->assertSame($data, $birthdate->toArray());
    }
}
