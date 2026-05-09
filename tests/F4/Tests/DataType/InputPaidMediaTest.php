<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\InputPaidMedia;
use F4\Pechkin\DataType\InputPaidMediaLivePhoto;
use F4\Pechkin\DataType\InputPaidMediaPhoto;
use F4\Pechkin\DataType\InputPaidMediaVideo;

final class InputPaidMediaTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithPhotoType(): void
    {
        $data = [
            ...$this->loadFixture('input_paid_media_photo_full.json'),
            'type' => 'photo',
        ];
        $result = InputPaidMedia::fromArray($data);
        $this->assertInstanceOf(InputPaidMediaPhoto::class, $result);
    }

    public function testFromArrayWithVideoType(): void
    {
        $data = [
            ...$this->loadFixture('input_paid_media_video_full.json'),
            'type' => 'video',
        ];
        $result = InputPaidMedia::fromArray($data);
        $this->assertInstanceOf(InputPaidMediaVideo::class, $result);
    }

    public function testFromArrayWithLivePhotoType(): void
    {
        $data = [
            ...$this->loadFixture('input_paid_media_live_photo_full.json'),
            'type' => 'live_photo',
        ];
        $result = InputPaidMedia::fromArray($data);
        $this->assertInstanceOf(InputPaidMediaLivePhoto::class, $result);
    }
}
