<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputStoryContentVideo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputStoryContentVideoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_story_content_video_full.json');
        $inputStoryContentVideo = InputStoryContentVideo::fromArray($data);

        $this->assertInstanceOf(InputStoryContentVideo::class, $inputStoryContentVideo);
        $this->assertSame('test_string', $inputStoryContentVideo->video);
        $this->assertSame(120.0, $inputStoryContentVideo->duration);
        $this->assertSame(3.14, $inputStoryContentVideo->cover_frame_timestamp);
        $this->assertSame(true, $inputStoryContentVideo->is_animation);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_story_content_video_minimal.json');
        $inputStoryContentVideo = InputStoryContentVideo::fromArray($data);

        $this->assertInstanceOf(InputStoryContentVideo::class, $inputStoryContentVideo);
        $this->assertNull($inputStoryContentVideo->duration);
        $this->assertNull($inputStoryContentVideo->cover_frame_timestamp);
        $this->assertNull($inputStoryContentVideo->is_animation);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_story_content_video_minimal.json');
        $inputStoryContentVideo = InputStoryContentVideo::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'video'], $inputStoryContentVideo->toArray());
    }
}
