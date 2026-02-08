<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaAudio;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputMediaAudioTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_media_audio_full.json');
        $inputMediaAudio = InputMediaAudio::fromArray($data);

        $this->assertInstanceOf(InputMediaAudio::class, $inputMediaAudio);
        $this->assertNotEmpty($inputMediaAudio->caption_entities);
        $this->assertSame('attach://file', $inputMediaAudio->media);
        $this->assertSame('test_string', $inputMediaAudio->thumbnail);
        $this->assertSame('Test caption', $inputMediaAudio->caption);
        $this->assertSame('HTML', $inputMediaAudio->parse_mode);
        $this->assertSame(120, $inputMediaAudio->duration);
        $this->assertSame('Test Artist', $inputMediaAudio->performer);
        $this->assertSame('Test Title', $inputMediaAudio->title);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_media_audio_minimal.json');
        $inputMediaAudio = InputMediaAudio::fromArray($data);

        $this->assertInstanceOf(InputMediaAudio::class, $inputMediaAudio);
        $this->assertNull($inputMediaAudio->thumbnail);
        $this->assertNull($inputMediaAudio->caption);
        $this->assertNull($inputMediaAudio->parse_mode);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_media_audio_minimal.json');
        $inputMediaAudio = InputMediaAudio::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'audio'], $inputMediaAudio->toArray());
    }
}
