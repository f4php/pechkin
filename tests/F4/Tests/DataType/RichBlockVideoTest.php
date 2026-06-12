<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockVideo;
use F4\Pechkin\DataType\Video;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockVideoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_video_full.json');
        $obj = RichBlockVideo::fromArray($data);

        $this->assertInstanceOf(RichBlockVideo::class, $obj);
        $this->assertSame('video', $obj->type);
        $this->assertInstanceOf(Video::class, $obj->video);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
        $this->assertSame(false, $obj->has_spoiler);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_video_minimal.json');
        $obj = RichBlockVideo::fromArray($data);

        $this->assertInstanceOf(RichBlockVideo::class, $obj);
        $this->assertNull($obj->has_spoiler);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_video_full.json');
        $obj = RichBlockVideo::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'video'], $obj->toArray());
    }
}
