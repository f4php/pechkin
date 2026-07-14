<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockAnimation;
use F4\Pechkin\DataType\InputMediaAnimation;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockAnimationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_animation_full.json');
        $obj = InputRichBlockAnimation::fromArray($data);

        $this->assertInstanceOf(InputRichBlockAnimation::class, $obj);
        $this->assertSame('animation', $obj->type);
        $this->assertInstanceOf(InputMediaAnimation::class, $obj->animation);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_rich_block_animation_minimal.json');
        $obj = InputRichBlockAnimation::fromArray($data);

        $this->assertInstanceOf(InputRichBlockAnimation::class, $obj);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_animation_full.json');
        $obj = InputRichBlockAnimation::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'animation', 'animation' => [...$data['animation'], 'type' => 'animation']], $obj->toArray());
    }
}
