<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockAnimation;
use F4\Pechkin\DataType\Animation;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockAnimationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_animation_full.json');
        $obj = RichBlockAnimation::fromArray($data);

        $this->assertInstanceOf(RichBlockAnimation::class, $obj);
        $this->assertSame('animation', $obj->type);
        $this->assertInstanceOf(Animation::class, $obj->animation);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
        $this->assertSame(true, $obj->has_spoiler);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_animation_minimal.json');
        $obj = RichBlockAnimation::fromArray($data);

        $this->assertInstanceOf(RichBlockAnimation::class, $obj);
        $this->assertNull($obj->has_spoiler);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_animation_full.json');
        $obj = RichBlockAnimation::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'animation'], $obj->toArray());
    }
}
