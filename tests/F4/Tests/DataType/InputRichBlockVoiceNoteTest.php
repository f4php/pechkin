<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockVoiceNote;
use F4\Pechkin\DataType\InputMediaVoiceNote;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockVoiceNoteTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_voice_note_full.json');
        $obj = InputRichBlockVoiceNote::fromArray($data);

        $this->assertInstanceOf(InputRichBlockVoiceNote::class, $obj);
        $this->assertSame('voice_note', $obj->type);
        $this->assertInstanceOf(InputMediaVoiceNote::class, $obj->voice_note);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_rich_block_voice_note_minimal.json');
        $obj = InputRichBlockVoiceNote::fromArray($data);

        $this->assertInstanceOf(InputRichBlockVoiceNote::class, $obj);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_voice_note_full.json');
        $obj = InputRichBlockVoiceNote::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'voice_note', 'voice_note' => [...$data['voice_note'], 'type' => 'voice_note']], $obj->toArray());
    }
}
