<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\File;
use F4\Pechkin\DataType\MaskPosition;
use F4\Pechkin\DataType\PhotoSize;
use F4\Pechkin\DataType\Sticker;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StickerTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('sticker_full.json');
        $sticker = Sticker::fromArray($data);

        $this->assertInstanceOf(Sticker::class, $sticker);
        $this->assertInstanceOf(PhotoSize::class, $sticker->thumbnail);
        $this->assertInstanceOf(File::class, $sticker->premium_animation);
        $this->assertInstanceOf(MaskPosition::class, $sticker->mask_position);
        $this->assertSame('BAACAgIAAxkBAAI', $sticker->file_id);
        $this->assertSame('AgADBAADZqc', $sticker->file_unique_id);
        $this->assertSame('regular', $sticker->type);
        $this->assertSame(640, $sticker->width);
        $this->assertSame(480, $sticker->height);
        $this->assertSame(false, $sticker->is_animated);
        $this->assertSame(false, $sticker->is_video);
        $this->assertSame('🎲', $sticker->emoji);
        $this->assertSame('test_sticker_set', $sticker->set_name);
        $this->assertSame('emoji_456', $sticker->custom_emoji_id);
        $this->assertSame(false, $sticker->needs_repainting);
        $this->assertSame(1024000, $sticker->file_size);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('sticker_minimal.json');
        $sticker = Sticker::fromArray($data);

        $this->assertInstanceOf(Sticker::class, $sticker);
        $this->assertNull($sticker->thumbnail);
        $this->assertNull($sticker->emoji);
        $this->assertNull($sticker->set_name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('sticker_minimal.json');
        $sticker = Sticker::fromArray($data);
        $this->assertEquals($data, $sticker->toArray());
    }
}
