<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BackgroundFillSolid;

final class BackgroundFillSolidTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'color' => 16777215,
        ];
        $fill = BackgroundFillSolid::fromArray($data);

        $this->assertSame(16777215, $fill->color);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = ['color' => 16777215];
        $fill = BackgroundFillSolid::fromArray($data);

        $this->assertSame($data, $fill->toArray());
    }
}
