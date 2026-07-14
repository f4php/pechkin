<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockAnchor;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockAnchorTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_anchor_full.json');
        $obj = InputRichBlockAnchor::fromArray($data);

        $this->assertInstanceOf(InputRichBlockAnchor::class, $obj);
        $this->assertSame('anchor', $obj->type);
        $this->assertSame('block-1', $obj->name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_anchor_full.json');
        $obj = InputRichBlockAnchor::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'anchor'], $obj->toArray());
    }
}
