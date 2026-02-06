<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\Audio;
use F4\Pechkin\DataType\PhotoSize;

final class AudioTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'file_id' => 'CQACAgIAAxkBAAI...',
            'file_unique_id' => 'AQADAgATqNAxG',
            'duration' => 180,
            'performer' => 'Artist Name',
            'title' => 'Song Title',
            'file_name' => 'song.mp3',
            'mime_type' => 'audio/mpeg',
            'file_size' => 5000000,
            'thumbnail' => [
                'file_id' => 'thumb_id',
                'file_unique_id' => 'thumb_unique',
                'width' => 100,
                'height' => 100,
            ],
        ];
        $audio = Audio::fromArray($data);

        $this->assertSame('CQACAgIAAxkBAAI...', $audio->file_id);
        $this->assertSame(180, $audio->duration);
        $this->assertSame('Artist Name', $audio->performer);
        $this->assertSame('Song Title', $audio->title);
        $this->assertSame('audio/mpeg', $audio->mime_type);
        $this->assertInstanceOf(PhotoSize::class, $audio->thumbnail);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = [
            'file_id' => 'CQACAgIAAxkBAAI...',
            'file_unique_id' => 'AQADAgATqNAxG',
            'duration' => 60,
        ];
        $audio = Audio::fromArray($data);

        $this->assertSame(60, $audio->duration);
        $this->assertNull($audio->performer);
        $this->assertNull($audio->title);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'file_id' => 'CQACAgIAAxkBAAI...',
            'file_unique_id' => 'AQADAgATqNAxG',
            'duration' => 180,
            'performer' => 'Artist Name',
            'title' => 'Song Title',
            'file_name' => null,
            'mime_type' => 'audio/mpeg',
            'file_size' => null,
            'thumbnail' => null,
        ];
        $audio = Audio::fromArray($data);
        $this->assertSame($data, $audio->toArray());
    }
}
