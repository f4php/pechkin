<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockVoiceNote;
use F4\Pechkin\DataType\Voice;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockVoiceNoteTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_voice_note_full.json');
        $obj = RichBlockVoiceNote::fromArray($data);

        $this->assertInstanceOf(RichBlockVoiceNote::class, $obj);
        $this->assertSame('voice_note', $obj->type);
        $this->assertInstanceOf(Voice::class, $obj->voice_note);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_voice_note_minimal.json');
        $obj = RichBlockVoiceNote::fromArray($data);

        $this->assertInstanceOf(RichBlockVoiceNote::class, $obj);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_voice_note_full.json');
        $obj = RichBlockVoiceNote::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'voice_note'], $obj->toArray());
    }
}
