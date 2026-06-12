<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockAnchor;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockAnchorTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_anchor_full.json');
        $obj = RichBlockAnchor::fromArray($data);

        $this->assertInstanceOf(RichBlockAnchor::class, $obj);
        $this->assertSame('anchor', $obj->type);
        $this->assertSame('block-1', $obj->name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_anchor_full.json');
        $obj = RichBlockAnchor::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'anchor'], $obj->toArray());
    }
}
