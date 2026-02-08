<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BackgroundFillFreeformGradient;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BackgroundFillFreeformGradientTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('background_fill_freeform_gradient_full.json');
        $backgroundFillFreeformGradient = BackgroundFillFreeformGradient::fromArray($data);

        $this->assertInstanceOf(BackgroundFillFreeformGradient::class, $backgroundFillFreeformGradient);
        $this->assertNotEmpty($backgroundFillFreeformGradient->colors);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('background_fill_freeform_gradient_minimal.json');
        $backgroundFillFreeformGradient = BackgroundFillFreeformGradient::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'freeform_gradient'], $backgroundFillFreeformGradient->toArray());
    }
}
