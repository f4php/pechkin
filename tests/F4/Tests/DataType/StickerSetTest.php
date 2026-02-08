<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PhotoSize;
use F4\Pechkin\DataType\StickerSet;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StickerSetTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('sticker_set_full.json');
        $stickerSet = StickerSet::fromArray($data);

        $this->assertInstanceOf(StickerSet::class, $stickerSet);
        $this->assertNotEmpty($stickerSet->stickers);
        $this->assertInstanceOf(PhotoSize::class, $stickerSet->thumbnail);
        $this->assertSame('Test Name', $stickerSet->name);
        $this->assertSame('Test Title', $stickerSet->title);
        $this->assertSame('regular', $stickerSet->sticker_type);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('sticker_set_minimal.json');
        $stickerSet = StickerSet::fromArray($data);

        $this->assertInstanceOf(StickerSet::class, $stickerSet);
        $this->assertNull($stickerSet->thumbnail);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('sticker_set_minimal.json');
        $stickerSet = StickerSet::fromArray($data);
        $this->assertEquals($data, $stickerSet->toArray());
    }
}
