<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\LivePhoto;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class LivePhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('live_photo_full.json');
        $livePhoto = LivePhoto::fromArray($data);

        $this->assertInstanceOf(LivePhoto::class, $livePhoto);
        $this->assertSame('BAACAgIAAxkBAAI', $livePhoto->file_id);
        $this->assertSame('AgADBAADZqc', $livePhoto->file_unique_id);
        $this->assertSame(1280, $livePhoto->width);
        $this->assertSame(720, $livePhoto->height);
        $this->assertSame(3, $livePhoto->duration);
        $this->assertIsArray($livePhoto->photo);
        $this->assertSame('video/mp4', $livePhoto->mime_type);
        $this->assertSame('102400', $livePhoto->file_size);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('live_photo_minimal.json');
        $livePhoto = LivePhoto::fromArray($data);

        $this->assertInstanceOf(LivePhoto::class, $livePhoto);
        $this->assertNull($livePhoto->photo);
        $this->assertNull($livePhoto->mime_type);
        $this->assertNull($livePhoto->file_size);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('live_photo_minimal.json');
        $livePhoto = LivePhoto::fromArray($data);
        $this->assertEquals($data, $livePhoto->toArray());
    }
}
