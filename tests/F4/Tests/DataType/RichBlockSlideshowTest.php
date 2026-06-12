<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockSlideshow;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockSlideshowTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_slideshow_full.json');
        $obj = RichBlockSlideshow::fromArray($data);

        $this->assertInstanceOf(RichBlockSlideshow::class, $obj);
        $this->assertSame('slideshow', $obj->type);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
        $this->assertNotEmpty($obj->blocks);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_slideshow_minimal.json');
        $obj = RichBlockSlideshow::fromArray($data);

        $this->assertInstanceOf(RichBlockSlideshow::class, $obj);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_slideshow_full.json');
        $obj = RichBlockSlideshow::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'slideshow'], $obj->toArray());
    }
}
