<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaSticker;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputMediaStickerTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_media_sticker_full.json');
        $ims = InputMediaSticker::fromArray($data);

        $this->assertInstanceOf(InputMediaSticker::class, $ims);
        $this->assertSame('sticker', $ims->type);
        $this->assertSame('BAACAgIAAxkBAAI', $ims->media);
        $this->assertSame('🎉', $ims->emoji);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_media_sticker_minimal.json');
        $ims = InputMediaSticker::fromArray($data);

        $this->assertInstanceOf(InputMediaSticker::class, $ims);
        $this->assertNull($ims->emoji);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_media_sticker_minimal.json');
        $ims = InputMediaSticker::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'sticker'], $ims->toArray());
    }
}
