<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BackgroundFill;
use F4\Pechkin\DataType\BackgroundFillSolid;
use F4\Pechkin\DataType\BackgroundFillGradient;
use F4\Pechkin\DataType\BackgroundFillFreeformGradient;

use function array_diff_key;

final class BackgroundFillTest extends TestCase
{
    public function testFromArrayWithSolidType(): void
    {
        $data = [
            'type' => 'solid',
            'color' => 16777215,
        ];
        $result = BackgroundFill::fromArray($data);
        $this->assertInstanceOf(BackgroundFillSolid::class, $result);
        $this->assertSame(16777215, $result->color);
    }

    public function testFromArrayWithGradientType(): void
    {
        $data = [
            'type' => 'gradient',
            'top_color' => 16777215,
            'bottom_color' => 0,
            'rotation_angle' => 45,
        ];
        $result = BackgroundFill::fromArray($data);
        $this->assertInstanceOf(BackgroundFillGradient::class, $result);
        $this->assertSame(16777215, $result->top_color);
        $this->assertSame(0, $result->bottom_color);
        $this->assertSame(45, $result->rotation_angle);
    }

    public function testFromArrayWithFreeformGradientType(): void
    {
        $data = [
            'type' => 'freeform_gradient',
            'colors' => [16777215, 0, 255, 65280],
        ];
        $result = BackgroundFill::fromArray($data);
        $this->assertInstanceOf(BackgroundFillFreeformGradient::class, $result);
        $this->assertSame([16777215, 0, 255, 65280], $result->colors);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'type' => 'gradient',
            'top_color' => 16777215,
            'bottom_color' => 0,
            'rotation_angle' => 45,
        ];
        $result = BackgroundFill::fromArray($data);
        unset($data['type']);
        $this->assertSame($data, $result->toArray());
    }
}
