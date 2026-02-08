<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BackgroundFillGradient;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BackgroundFillGradientTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('background_fill_gradient_full.json');
        $backgroundFillGradient = BackgroundFillGradient::fromArray($data);

        $this->assertInstanceOf(BackgroundFillGradient::class, $backgroundFillGradient);
        $this->assertSame(16711680, $backgroundFillGradient->top_color);
        $this->assertSame(255, $backgroundFillGradient->bottom_color);
        $this->assertSame(45, $backgroundFillGradient->rotation_angle);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('background_fill_gradient_minimal.json');
        $backgroundFillGradient = BackgroundFillGradient::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'gradient'], $backgroundFillGradient->toArray());
    }
}
