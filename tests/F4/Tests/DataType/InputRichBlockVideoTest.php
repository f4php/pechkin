<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockVideo;
use F4\Pechkin\DataType\InputMediaVideo;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockVideoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_video_full.json');
        $obj = InputRichBlockVideo::fromArray($data);

        $this->assertInstanceOf(InputRichBlockVideo::class, $obj);
        $this->assertSame('video', $obj->type);
        $this->assertInstanceOf(InputMediaVideo::class, $obj->video);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_rich_block_video_minimal.json');
        $obj = InputRichBlockVideo::fromArray($data);

        $this->assertInstanceOf(InputRichBlockVideo::class, $obj);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_video_full.json');
        $obj = InputRichBlockVideo::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'video', 'video' => [...$data['video'], 'type' => 'video']], $obj->toArray());
    }
}
