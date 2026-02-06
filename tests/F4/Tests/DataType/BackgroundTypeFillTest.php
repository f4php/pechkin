<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BackgroundTypeFill;
use F4\Pechkin\DataType\BackgroundFill;

final class BackgroundTypeFillTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'fill' => ['type' => 'solid', 'color' => 16777215],
            'dark_theme_dimming' => 50,
        ];
        $fill = BackgroundTypeFill::fromArray($data);
        $this->assertInstanceOf(BackgroundFill::class, $fill->fill);
        $this->assertSame(50, $fill->dark_theme_dimming);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'fill' => [
                'type' => 'solid',
                'color' => 255
            ],
            'dark_theme_dimming' => 75,
        ];
        $fill = BackgroundTypeFill::fromArray($data);
        unset($data['fill']['type']);
        $this->assertSame($data, $fill->toArray());
    }
}
