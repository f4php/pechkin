<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PaidMediaVideo;
use F4\Pechkin\DataType\Video;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PaidMediaVideoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('paid_media_video_full.json');
        $paidMediaVideo = PaidMediaVideo::fromArray($data);

        $this->assertInstanceOf(PaidMediaVideo::class, $paidMediaVideo);
        $this->assertInstanceOf(Video::class, $paidMediaVideo->video);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('paid_media_video_minimal.json');
        $paidMediaVideo = PaidMediaVideo::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'video'], $paidMediaVideo->toArray());
    }
}
