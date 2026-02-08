<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BackgroundFill;
use F4\Pechkin\DataType\BackgroundFillSolid;
use F4\Pechkin\DataType\BackgroundFillGradient;
use F4\Pechkin\DataType\BackgroundFillFreeformGradient;

final class BackgroundFillTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithSolidType(): void
    {
        $data = [
            ...$this->loadFixture('background_fill_solid_full.json'),
            'type' => 'solid',
        ];
        $result = BackgroundFill::fromArray($data);
        $this->assertInstanceOf(BackgroundFillSolid::class, $result);
    }

    public function testFromArrayWithGradientType(): void
    {
        $data = [
            ...$this->loadFixture('background_fill_gradient_full.json'),
            'type' => 'gradient',
        ];
        $result = BackgroundFill::fromArray($data);
        $this->assertInstanceOf(BackgroundFillGradient::class, $result);
    }

    public function testFromArrayWithFreeformGradientType(): void
    {
        $data = [
            ...$this->loadFixture('background_fill_freeform_gradient_full.json'),
            'type' => 'freeform_gradient',
        ];
        $result = BackgroundFill::fromArray($data);
        $this->assertInstanceOf(BackgroundFillFreeformGradient::class, $result);
    }
}
