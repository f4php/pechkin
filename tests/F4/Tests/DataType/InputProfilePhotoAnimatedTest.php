<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputProfilePhotoAnimated;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputProfilePhotoAnimatedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_profile_photo_animated_full.json');
        $inputProfilePhotoAnimated = InputProfilePhotoAnimated::fromArray($data);

        $this->assertInstanceOf(InputProfilePhotoAnimated::class, $inputProfilePhotoAnimated);
        $this->assertSame('animation_file_id', $inputProfilePhotoAnimated->animation);
        $this->assertSame(3.14, $inputProfilePhotoAnimated->main_frame_timestamp);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_profile_photo_animated_minimal.json');
        $inputProfilePhotoAnimated = InputProfilePhotoAnimated::fromArray($data);

        $this->assertInstanceOf(InputProfilePhotoAnimated::class, $inputProfilePhotoAnimated);
        $this->assertNull($inputProfilePhotoAnimated->main_frame_timestamp);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_profile_photo_animated_minimal.json');
        $inputProfilePhotoAnimated = InputProfilePhotoAnimated::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'animated'], $inputProfilePhotoAnimated->toArray());
    }
}
