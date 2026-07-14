<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaVoiceNote;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputMediaVoiceNoteTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_media_voice_note_full.json');
        $inputMediaVoiceNote = InputMediaVoiceNote::fromArray($data);

        $this->assertInstanceOf(InputMediaVoiceNote::class, $inputMediaVoiceNote);
        $this->assertSame('voice_note', $inputMediaVoiceNote->type);
        $this->assertSame('attach://voice.ogg', $inputMediaVoiceNote->media);
        $this->assertSame('A voice note', $inputMediaVoiceNote->caption);
        $this->assertSame('MarkdownV2', $inputMediaVoiceNote->parse_mode);
        $this->assertNotEmpty($inputMediaVoiceNote->caption_entities);
        $this->assertSame(12, $inputMediaVoiceNote->duration);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_media_voice_note_minimal.json');
        $inputMediaVoiceNote = InputMediaVoiceNote::fromArray($data);

        $this->assertInstanceOf(InputMediaVoiceNote::class, $inputMediaVoiceNote);
        $this->assertSame('voice_note', $inputMediaVoiceNote->type);
        $this->assertSame('attach://voice.ogg', $inputMediaVoiceNote->media);
        $this->assertNull($inputMediaVoiceNote->caption);
        $this->assertNull($inputMediaVoiceNote->duration);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_media_voice_note_minimal.json');
        $inputMediaVoiceNote = InputMediaVoiceNote::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'voice_note'], $inputMediaVoiceNote->toArray());
    }
}
