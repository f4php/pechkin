<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\InputMedia;
use F4\Pechkin\DataType\InputMediaPhoto;
use F4\Pechkin\DataType\InputMediaVideo;
use F4\Pechkin\DataType\InputMediaAnimation;
use F4\Pechkin\DataType\InputMediaAudio;
use F4\Pechkin\DataType\InputMediaDocument;

final class InputMediaTest extends TestCase
{
    use FixtureAwareTrait;


    public function testFromArrayWithPhotoType(): void
    {
        $data = [
            ...$this->loadFixture('input_media_photo_full.json'),
            'type' => 'photo',
        ];
        $result = InputMedia::fromArray($data);
        $this->assertInstanceOf(InputMediaPhoto::class, $result);
    }

    public function testFromArrayWithVideoType(): void
    {
        $data = [
            ...$this->loadFixture('input_media_video_full.json'),
            'type' => 'video',
        ];
        $result = InputMedia::fromArray($data);
        $this->assertInstanceOf(InputMediaVideo::class, $result);
    }

    public function testFromArrayWithAnimationType(): void
    {
        $data = [
            ...$this->loadFixture('input_media_animation_full.json'),
            'type' => 'animation',
        ];
        $result = InputMedia::fromArray($data);
        $this->assertInstanceOf(InputMediaAnimation::class, $result);
    }

    public function testFromArrayWithAudioType(): void
    {
        $data = [
            ...$this->loadFixture('input_media_audio_full.json'),
            'type' => 'audio',
        ];
        $result = InputMedia::fromArray($data);
        $this->assertInstanceOf(InputMediaAudio::class, $result);
    }

    public function testFromArrayWithDocumentType(): void
    {
        $data = [
            ...$this->loadFixture('input_media_document_full.json'),
            'type' => 'document',
        ];
        $result = InputMedia::fromArray($data);
        $this->assertInstanceOf(InputMediaDocument::class, $result);
    }
}
