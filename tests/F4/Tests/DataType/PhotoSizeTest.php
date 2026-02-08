<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PhotoSize;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PhotoSizeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('photo_size_full.json');
        $photoSize = PhotoSize::fromArray($data);

        $this->assertInstanceOf(PhotoSize::class, $photoSize);
        $this->assertSame('BAACAgIAAxkBAAI', $photoSize->file_id);
        $this->assertSame('AgADBAADZqc', $photoSize->file_unique_id);
        $this->assertSame(640, $photoSize->width);
        $this->assertSame(480, $photoSize->height);
        $this->assertSame(1024000, $photoSize->file_size);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('photo_size_minimal.json');
        $photoSize = PhotoSize::fromArray($data);

        $this->assertInstanceOf(PhotoSize::class, $photoSize);
        $this->assertNull($photoSize->file_size);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('photo_size_minimal.json');
        $photoSize = PhotoSize::fromArray($data);
        $this->assertEquals($data, $photoSize->toArray());
    }
}
