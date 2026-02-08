<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Animation;
use F4\Pechkin\DataType\PhotoSize;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class AnimationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('animation_full.json');
        $animation = Animation::fromArray($data);

        $this->assertInstanceOf(Animation::class, $animation);
        $this->assertInstanceOf(PhotoSize::class, $animation->thumbnail);
        $this->assertSame('BAACAgIAAxkBAAI', $animation->file_id);
        $this->assertSame('AgADBAADZqc', $animation->file_unique_id);
        $this->assertSame(640, $animation->width);
        $this->assertSame(480, $animation->height);
        $this->assertSame(120, $animation->duration);
        $this->assertSame('test_file.pdf', $animation->file_name);
        $this->assertSame('application/pdf', $animation->mime_type);
        $this->assertSame('1024000', $animation->file_size);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('animation_minimal.json');
        $animation = Animation::fromArray($data);

        $this->assertInstanceOf(Animation::class, $animation);
        $this->assertNull($animation->thumbnail);
        $this->assertNull($animation->file_name);
        $this->assertNull($animation->mime_type);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('animation_minimal.json');
        $animation = Animation::fromArray($data);
        $this->assertEquals($data, $animation->toArray());
    }
}
