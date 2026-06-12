<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockCollage;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockCollageTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_collage_full.json');
        $obj = RichBlockCollage::fromArray($data);

        $this->assertInstanceOf(RichBlockCollage::class, $obj);
        $this->assertSame('collage', $obj->type);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
        $this->assertNotEmpty($obj->blocks);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_collage_minimal.json');
        $obj = RichBlockCollage::fromArray($data);

        $this->assertInstanceOf(RichBlockCollage::class, $obj);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_collage_full.json');
        $obj = RichBlockCollage::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'collage'], $obj->toArray());
    }
}
