<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputProfilePhotoStatic;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputProfilePhotoStaticTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_profile_photo_static_full.json');
        $inputProfilePhotoStatic = InputProfilePhotoStatic::fromArray($data);

        $this->assertInstanceOf(InputProfilePhotoStatic::class, $inputProfilePhotoStatic);
        $this->assertSame('photo_file_id', $inputProfilePhotoStatic->photo);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_profile_photo_static_minimal.json');
        $inputProfilePhotoStatic = InputProfilePhotoStatic::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'static'], $inputProfilePhotoStatic->toArray());
    }
}
