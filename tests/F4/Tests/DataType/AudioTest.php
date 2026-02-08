<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Audio;
use F4\Pechkin\DataType\PhotoSize;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class AudioTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('audio_full.json');
        $audio = Audio::fromArray($data);

        $this->assertInstanceOf(Audio::class, $audio);
        $this->assertInstanceOf(PhotoSize::class, $audio->thumbnail);
        $this->assertSame('BAACAgIAAxkBAAI', $audio->file_id);
        $this->assertSame('AgADBAADZqc', $audio->file_unique_id);
        $this->assertSame(120, $audio->duration);
        $this->assertSame('Test Artist', $audio->performer);
        $this->assertSame('Test Title', $audio->title);
        $this->assertSame('test_file.pdf', $audio->file_name);
        $this->assertSame('application/pdf', $audio->mime_type);
        $this->assertSame('1024000', $audio->file_size);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('audio_minimal.json');
        $audio = Audio::fromArray($data);

        $this->assertInstanceOf(Audio::class, $audio);
        $this->assertNull($audio->performer);
        $this->assertNull($audio->title);
        $this->assertNull($audio->file_name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('audio_minimal.json');
        $audio = Audio::fromArray($data);
        $this->assertEquals($data, $audio->toArray());
    }
}
