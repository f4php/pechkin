<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PhotoSize;
use F4\Pechkin\DataType\Video;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class VideoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('video_full.json');
        $video = Video::fromArray($data);

        $this->assertInstanceOf(Video::class, $video);
        $this->assertInstanceOf(PhotoSize::class, $video->thumbnail);
        $this->assertNotEmpty($video->cover);
        $this->assertSame('BAACAgIAAxkBAAI', $video->file_id);
        $this->assertSame('AgADBAADZqc', $video->file_unique_id);
        $this->assertSame(640, $video->width);
        $this->assertSame(480, $video->height);
        $this->assertSame(120, $video->duration);
        $this->assertSame(42, $video->start_timestamp);
        $this->assertSame('test_file.pdf', $video->file_name);
        $this->assertSame('application/pdf', $video->mime_type);
        $this->assertSame('1024000', $video->file_size);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('video_minimal.json');
        $video = Video::fromArray($data);

        $this->assertInstanceOf(Video::class, $video);
        $this->assertNull($video->thumbnail);
        $this->assertNull($video->cover);
        $this->assertNull($video->start_timestamp);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('video_minimal.json');
        $video = Video::fromArray($data);
        $this->assertEquals($data, $video->toArray());
    }
}
