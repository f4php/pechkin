<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockAudio;
use F4\Pechkin\DataType\Audio;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockAudioTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_audio_full.json');
        $obj = RichBlockAudio::fromArray($data);

        $this->assertInstanceOf(RichBlockAudio::class, $obj);
        $this->assertSame('audio', $obj->type);
        $this->assertInstanceOf(Audio::class, $obj->audio);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_audio_minimal.json');
        $obj = RichBlockAudio::fromArray($data);

        $this->assertInstanceOf(RichBlockAudio::class, $obj);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_audio_full.json');
        $obj = RichBlockAudio::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'audio'], $obj->toArray());
    }
}
