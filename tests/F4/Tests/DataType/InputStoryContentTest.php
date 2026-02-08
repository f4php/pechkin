<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\InputStoryContent;
use F4\Pechkin\DataType\InputStoryContentPhoto;
use F4\Pechkin\DataType\InputStoryContentVideo;

final class InputStoryContentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithPhotoType(): void
    {
        $data = [
            ...$this->loadFixture('input_story_content_photo_full.json'),
            'type' => 'photo',
        ];
        $result = InputStoryContent::fromArray($data);
        $this->assertInstanceOf(InputStoryContentPhoto::class, $result);
    }

    public function testFromArrayWithVideoType(): void
    {
        $data = [
            ...$this->loadFixture('input_story_content_video_full.json'),
            'type' => 'video',
        ];
        $result = InputStoryContent::fromArray($data);
        $this->assertInstanceOf(InputStoryContentVideo::class, $result);
    }
}
