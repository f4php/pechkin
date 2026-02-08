<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputStoryContentPhoto;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputStoryContentPhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_story_content_photo_full.json');
        $inputStoryContentPhoto = InputStoryContentPhoto::fromArray($data);

        $this->assertInstanceOf(InputStoryContentPhoto::class, $inputStoryContentPhoto);
        $this->assertSame('photo_file_id', $inputStoryContentPhoto->photo);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_story_content_photo_minimal.json');
        $inputStoryContentPhoto = InputStoryContentPhoto::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'photo'], $inputStoryContentPhoto->toArray());
    }
}
