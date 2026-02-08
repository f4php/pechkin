<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaPhoto;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputMediaPhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_media_photo_full.json');
        $inputMediaPhoto = InputMediaPhoto::fromArray($data);

        $this->assertInstanceOf(InputMediaPhoto::class, $inputMediaPhoto);
        $this->assertNotEmpty($inputMediaPhoto->caption_entities);
        $this->assertSame('attach://file', $inputMediaPhoto->media);
        $this->assertSame('Test caption', $inputMediaPhoto->caption);
        $this->assertSame('HTML', $inputMediaPhoto->parse_mode);
        $this->assertSame(false, $inputMediaPhoto->show_caption_above_media);
        $this->assertSame(true, $inputMediaPhoto->has_spoiler);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_media_photo_minimal.json');
        $inputMediaPhoto = InputMediaPhoto::fromArray($data);

        $this->assertInstanceOf(InputMediaPhoto::class, $inputMediaPhoto);
        $this->assertNull($inputMediaPhoto->caption);
        $this->assertNull($inputMediaPhoto->parse_mode);
        $this->assertNull($inputMediaPhoto->caption_entities);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_media_photo_minimal.json');
        $inputMediaPhoto = InputMediaPhoto::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'photo'], $inputMediaPhoto->toArray());
    }
}
