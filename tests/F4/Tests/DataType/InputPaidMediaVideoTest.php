<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputPaidMediaVideo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputPaidMediaVideoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_paid_media_video_full.json');
        $inputPaidMediaVideo = InputPaidMediaVideo::fromArray($data);

        $this->assertInstanceOf(InputPaidMediaVideo::class, $inputPaidMediaVideo);
        $this->assertSame('attach://file', $inputPaidMediaVideo->media);
        $this->assertSame('test_string', $inputPaidMediaVideo->thumbnail);
        $this->assertSame('test_string', $inputPaidMediaVideo->cover);
        $this->assertSame(42, $inputPaidMediaVideo->start_timestamp);
        $this->assertSame(640, $inputPaidMediaVideo->width);
        $this->assertSame(480, $inputPaidMediaVideo->height);
        $this->assertSame(120, $inputPaidMediaVideo->duration);
        $this->assertSame(true, $inputPaidMediaVideo->supports_streaming);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_paid_media_video_minimal.json');
        $inputPaidMediaVideo = InputPaidMediaVideo::fromArray($data);

        $this->assertInstanceOf(InputPaidMediaVideo::class, $inputPaidMediaVideo);
        $this->assertNull($inputPaidMediaVideo->thumbnail);
        $this->assertNull($inputPaidMediaVideo->cover);
        $this->assertNull($inputPaidMediaVideo->start_timestamp);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_paid_media_video_minimal.json');
        $inputPaidMediaVideo = InputPaidMediaVideo::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'video'], $inputPaidMediaVideo->toArray());
    }
}
