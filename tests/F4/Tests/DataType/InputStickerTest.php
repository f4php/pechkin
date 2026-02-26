<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputSticker;
use F4\Pechkin\DataType\MaskPosition;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputStickerTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_sticker_full.json');
        $inputSticker = InputSticker::fromArray($data);

        $this->assertInstanceOf(InputSticker::class, $inputSticker);
        $this->assertInstanceOf(MaskPosition::class, $inputSticker->mask_position);
        $this->assertNotEmpty($inputSticker->keywords);
        $this->assertSame('sticker_file_id', $inputSticker->sticker);
        $this->assertSame('static', $inputSticker->format);
        $this->assertSame('👍', $inputSticker->emoji_list[0]);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_sticker_minimal.json');
        $inputSticker = InputSticker::fromArray($data);

        $this->assertInstanceOf(InputSticker::class, $inputSticker);
        $this->assertNull($inputSticker->mask_position);
        $this->assertNull($inputSticker->keywords);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_sticker_minimal.json');
        $inputSticker = InputSticker::fromArray($data);
        $this->assertEquals($data, $inputSticker->toArray());
    }
}
