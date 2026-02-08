<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PhotoSize;
use F4\Pechkin\DataType\VideoNote;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class VideoNoteTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('video_note_full.json');
        $videoNote = VideoNote::fromArray($data);

        $this->assertInstanceOf(VideoNote::class, $videoNote);
        $this->assertInstanceOf(PhotoSize::class, $videoNote->thumbnail);
        $this->assertSame('BAACAgIAAxkBAAI', $videoNote->file_id);
        $this->assertSame('AgADBAADZqc', $videoNote->file_unique_id);
        $this->assertSame(240, $videoNote->length);
        $this->assertSame(120, $videoNote->duration);
        $this->assertSame('1024000', $videoNote->file_size);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('video_note_minimal.json');
        $videoNote = VideoNote::fromArray($data);

        $this->assertInstanceOf(VideoNote::class, $videoNote);
        $this->assertNull($videoNote->thumbnail);
        $this->assertNull($videoNote->file_size);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('video_note_minimal.json');
        $videoNote = VideoNote::fromArray($data);
        $this->assertEquals($data, $videoNote->toArray());
    }
}
