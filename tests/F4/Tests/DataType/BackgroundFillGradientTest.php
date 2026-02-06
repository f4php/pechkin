<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BackgroundFillGradient;

final class BackgroundFillGradientTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'top_color' => 16777215,
            'bottom_color' => 0,
            'rotation_angle' => 45,
        ];
        $fill = BackgroundFillGradient::fromArray($data);

        $this->assertSame(16777215, $fill->top_color);
        $this->assertSame(0, $fill->bottom_color);
        $this->assertSame(45, $fill->rotation_angle);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'top_color' => 16777215,
            'bottom_color' => 0,
            'rotation_angle' => 45,
        ];
        $fill = BackgroundFillGradient::fromArray($data);

        $this->assertSame($data, $fill->toArray());
    }
}
