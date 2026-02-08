<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaVideo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputMediaVideoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_media_video_full.json');
        $inputMediaVideo = InputMediaVideo::fromArray($data);

        $this->assertInstanceOf(InputMediaVideo::class, $inputMediaVideo);
        $this->assertNotEmpty($inputMediaVideo->caption_entities);
        $this->assertSame('attach://file', $inputMediaVideo->media);
        $this->assertSame('test_string', $inputMediaVideo->thumbnail);
        $this->assertSame('test_string', $inputMediaVideo->cover);
        $this->assertSame(42, $inputMediaVideo->start_timestamp);
        $this->assertSame('Test caption', $inputMediaVideo->caption);
        $this->assertSame('HTML', $inputMediaVideo->parse_mode);
        $this->assertSame(640, $inputMediaVideo->width);
        $this->assertSame(480, $inputMediaVideo->height);
        $this->assertSame(120, $inputMediaVideo->duration);
        $this->assertSame(true, $inputMediaVideo->supports_streaming);
        $this->assertSame(true, $inputMediaVideo->has_spoiler);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_media_video_minimal.json');
        $inputMediaVideo = InputMediaVideo::fromArray($data);

        $this->assertInstanceOf(InputMediaVideo::class, $inputMediaVideo);
        $this->assertNull($inputMediaVideo->thumbnail);
        $this->assertNull($inputMediaVideo->cover);
        $this->assertNull($inputMediaVideo->start_timestamp);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_media_video_minimal.json');
        $inputMediaVideo = InputMediaVideo::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'video'], $inputMediaVideo->toArray());
    }
}
