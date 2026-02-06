<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\Animation;
use F4\Pechkin\DataType\PhotoSize;

final class AnimationTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'file_id' => 'CgACAgIAAxkBAAI...',
            'file_unique_id' => 'AQADAgATqNAxG',
            'width' => 480,
            'height' => 480,
            'duration' => 5,
            'thumbnail' => [
                'file_id' => 'thumb_id',
                'file_unique_id' => 'thumb_unique',
                'width' => 90,
                'height' => 90,
            ],
            'file_name' => 'animation.gif',
            'mime_type' => 'video/mp4',
            'file_size' => 500000,
        ];
        $animation = Animation::fromArray($data);

        $this->assertSame('CgACAgIAAxkBAAI...', $animation->file_id);
        $this->assertSame(480, $animation->width);
        $this->assertSame(480, $animation->height);
        $this->assertSame(5, $animation->duration);
        $this->assertInstanceOf(PhotoSize::class, $animation->thumbnail);
        $this->assertSame('animation.gif', $animation->file_name);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = [
            'file_id' => 'CgACAgIAAxkBAAI...',
            'file_unique_id' => 'AQADAgATqNAxG',
            'width' => 480,
            'height' => 480,
            'duration' => 3,
        ];
        $animation = Animation::fromArray($data);

        $this->assertSame(480, $animation->width);
        $this->assertSame(3, $animation->duration);
        $this->assertNull($animation->thumbnail);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'file_id' => 'CgACAgIAAxkBAAI...',
            'file_unique_id' => 'AQADAgATqNAxG',
            'width' => 480,
            'height' => 480,
            'duration' => 5,
            'thumbnail' => null,
            'file_name' => 'animation.gif',
            'mime_type' => 'video/mp4',
            'file_size' => '500000',
        ];
        $animation = Animation::fromArray($data);
        
        $this->assertSame($data, $animation->toArray());
    }
}
