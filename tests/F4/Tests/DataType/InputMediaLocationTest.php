<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaLocation;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputMediaLocationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_media_location_full.json');
        $iml = InputMediaLocation::fromArray($data);

        $this->assertInstanceOf(InputMediaLocation::class, $iml);
        $this->assertSame('location', $iml->type);
        $this->assertSame(55.7558, $iml->latitude);
        $this->assertSame(37.6173, $iml->longitude);
        $this->assertSame(10.5, $iml->horizontal_accuracy);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_media_location_minimal.json');
        $iml = InputMediaLocation::fromArray($data);

        $this->assertInstanceOf(InputMediaLocation::class, $iml);
        $this->assertNull($iml->horizontal_accuracy);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_media_location_minimal.json');
        $iml = InputMediaLocation::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'location'], $iml->toArray());
    }
}
