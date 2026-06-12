<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaAnimation;
use F4\Pechkin\DataType\InputMediaLink;
use F4\Pechkin\DataType\InputMediaPhoto;
use F4\Pechkin\DataType\InputMediaSticker;
use F4\Pechkin\DataType\InputMediaVideo;
use F4\Pechkin\DataType\InputPollOptionMedia;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputPollOptionMediaTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithPhotoType(): void
    {
        $data = [
            ...$this->loadFixture('input_media_photo_full.json'),
            'type' => 'photo',
        ];
        $result = InputPollOptionMedia::fromArray($data);
        $this->assertInstanceOf(InputMediaPhoto::class, $result);
    }

    public function testFromArrayWithVideoType(): void
    {
        $data = [
            ...$this->loadFixture('input_media_video_full.json'),
            'type' => 'video',
        ];
        $result = InputPollOptionMedia::fromArray($data);
        $this->assertInstanceOf(InputMediaVideo::class, $result);
    }

    public function testFromArrayWithAnimationType(): void
    {
        $data = [
            ...$this->loadFixture('input_media_animation_full.json'),
            'type' => 'animation',
        ];
        $result = InputPollOptionMedia::fromArray($data);
        $this->assertInstanceOf(InputMediaAnimation::class, $result);
    }

    public function testFromArrayWithStickerType(): void
    {
        $data = [
            ...$this->loadFixture('input_media_sticker_full.json'),
            'type' => 'sticker',
        ];
        $result = InputPollOptionMedia::fromArray($data);
        $this->assertInstanceOf(InputMediaSticker::class, $result);
    }

    public function testFromArrayWithLinkType(): void
    {
        $data = [
            ...$this->loadFixture('input_media_link_full.json'),
            'type' => 'link',
        ];
        $result = InputPollOptionMedia::fromArray($data);
        $this->assertInstanceOf(InputMediaLink::class, $result);
    }
}
