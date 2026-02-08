<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\PaidMedia;
use F4\Pechkin\DataType\PaidMediaPhoto;
use F4\Pechkin\DataType\PaidMediaVideo;
use F4\Pechkin\DataType\PaidMediaPreview;

final class PaidMediaTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithPhotoType(): void
    {
        $data = [
            ...$this->loadFixture('paid_media_photo_full.json'),
            'type' => 'photo',
        ];
        $result = PaidMedia::fromArray($data);
        $this->assertInstanceOf(PaidMediaPhoto::class, $result);
    }

    public function testFromArrayWithVideoType(): void
    {
        $data = [
            ...$this->loadFixture('paid_media_video_full.json'),
            'type' => 'video',
        ];
        $result = PaidMedia::fromArray($data);
        $this->assertInstanceOf(PaidMediaVideo::class, $result);
    }

    public function testFromArrayWithPreviewType(): void
    {
        $data = [
            ...$this->loadFixture('paid_media_preview_full.json'),
            'type' => 'preview',
        ];
        $result = PaidMedia::fromArray($data);
        $this->assertInstanceOf(PaidMediaPreview::class, $result);
    }
}
