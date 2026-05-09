<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\VideoQuality;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class VideoQualityTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('video_quality_full.json');
        $vq = VideoQuality::fromArray($data);

        $this->assertInstanceOf(VideoQuality::class, $vq);
        $this->assertSame('BAACAgIAAxkBAAI', $vq->file_id);
        $this->assertSame('AgADBAADZqc', $vq->file_unique_id);
        $this->assertSame(1920, $vq->width);
        $this->assertSame(1080, $vq->height);
        $this->assertSame('h264', $vq->codec);
        $this->assertSame('52428800', $vq->file_size);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('video_quality_minimal.json');
        $vq = VideoQuality::fromArray($data);

        $this->assertInstanceOf(VideoQuality::class, $vq);
        $this->assertNull($vq->file_size);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('video_quality_minimal.json');
        $vq = VideoQuality::fromArray($data);
        $this->assertEquals($data, $vq->toArray());
    }
}
