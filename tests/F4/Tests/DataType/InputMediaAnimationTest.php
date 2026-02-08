<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaAnimation;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputMediaAnimationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_media_animation_full.json');
        $inputMediaAnimation = InputMediaAnimation::fromArray($data);

        $this->assertInstanceOf(InputMediaAnimation::class, $inputMediaAnimation);
        $this->assertNotEmpty($inputMediaAnimation->caption_entities);
        $this->assertSame('attach://file', $inputMediaAnimation->media);
        $this->assertSame('test_string', $inputMediaAnimation->thumbnail);
        $this->assertSame('Test caption', $inputMediaAnimation->caption);
        $this->assertSame('HTML', $inputMediaAnimation->parse_mode);
        $this->assertSame(false, $inputMediaAnimation->show_caption_above_media);
        $this->assertSame(640, $inputMediaAnimation->width);
        $this->assertSame(480, $inputMediaAnimation->height);
        $this->assertSame(120, $inputMediaAnimation->duration);
        $this->assertSame(true, $inputMediaAnimation->has_spoiler);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_media_animation_minimal.json');
        $inputMediaAnimation = InputMediaAnimation::fromArray($data);

        $this->assertInstanceOf(InputMediaAnimation::class, $inputMediaAnimation);
        $this->assertNull($inputMediaAnimation->thumbnail);
        $this->assertNull($inputMediaAnimation->caption);
        $this->assertNull($inputMediaAnimation->parse_mode);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_media_animation_minimal.json');
        $inputMediaAnimation = InputMediaAnimation::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'animation'], $inputMediaAnimation->toArray());
    }
}
