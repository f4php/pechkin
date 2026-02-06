<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BackgroundFillFreeformGradient;

final class BackgroundFillFreeformGradientTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'colors' => [127, 0, 255, 32],
        ];
        $fill = BackgroundFillFreeformGradient::fromArray($data);

        $this->assertSame([127, 0, 255, 32], $fill->colors);
        $this->assertCount(4, $fill->colors);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'colors' => [127, 0, 255, 32],
        ];
        $fill = BackgroundFillFreeformGradient::fromArray($data);

        $this->assertSame($data, $fill->toArray());
    }
}
