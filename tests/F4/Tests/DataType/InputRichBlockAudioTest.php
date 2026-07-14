<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockAudio;
use F4\Pechkin\DataType\InputMediaAudio;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockAudioTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_audio_full.json');
        $obj = InputRichBlockAudio::fromArray($data);

        $this->assertInstanceOf(InputRichBlockAudio::class, $obj);
        $this->assertSame('audio', $obj->type);
        $this->assertInstanceOf(InputMediaAudio::class, $obj->audio);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_rich_block_audio_minimal.json');
        $obj = InputRichBlockAudio::fromArray($data);

        $this->assertInstanceOf(InputRichBlockAudio::class, $obj);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_audio_full.json');
        $obj = InputRichBlockAudio::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'audio', 'audio' => [...$data['audio'], 'type' => 'audio']], $obj->toArray());
    }
}
