<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PollMedia;
use F4\Pechkin\DataType\Video;
use F4\Tests\DataType\FixtureAwareTrait;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class PollMediaTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('poll_media_full.json');
        $pollMedia = PollMedia::fromArray($data);

        $this->assertInstanceOf(PollMedia::class, $pollMedia);
        $this->assertIsArray($pollMedia->photo);
        $this->assertNull($pollMedia->animation);
        $this->assertNull($pollMedia->video);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('poll_media_minimal.json');
        $pollMedia = PollMedia::fromArray($data);

        $this->assertInstanceOf(PollMedia::class, $pollMedia);
        $this->assertNull($pollMedia->animation);
        $this->assertNull($pollMedia->audio);
        $this->assertNull($pollMedia->document);
        $this->assertNull($pollMedia->live_photo);
        $this->assertNull($pollMedia->location);
        $this->assertNull($pollMedia->photo);
        $this->assertNull($pollMedia->sticker);
        $this->assertNull($pollMedia->venue);
        $this->assertNull($pollMedia->video);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('poll_media_minimal.json');
        $pollMedia = PollMedia::fromArray($data);
        $this->assertEquals($data, $pollMedia->toArray());
    }

    public function testThrowsWhenMultipleMediaFieldsSet(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $video = Video::fromArray($this->loadFixture('video_minimal.json'));
        $photo = [$this->loadFixture('photo_size_minimal.json')];
        new PollMedia(photo: $photo, video: $video);
    }
}
