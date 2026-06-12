<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockPhoto;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockPhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_photo_full.json');
        $obj = RichBlockPhoto::fromArray($data);

        $this->assertInstanceOf(RichBlockPhoto::class, $obj);
        $this->assertSame('photo', $obj->type);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
        $this->assertNotEmpty($obj->photo);
        $this->assertSame(true, $obj->has_spoiler);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_photo_minimal.json');
        $obj = RichBlockPhoto::fromArray($data);

        $this->assertInstanceOf(RichBlockPhoto::class, $obj);
        $this->assertNull($obj->has_spoiler);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_photo_full.json');
        $obj = RichBlockPhoto::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'photo'], $obj->toArray());
    }
}
