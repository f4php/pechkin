<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockMap;
use F4\Pechkin\DataType\Location;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockMapTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_map_full.json');
        $obj = RichBlockMap::fromArray($data);

        $this->assertInstanceOf(RichBlockMap::class, $obj);
        $this->assertSame('map', $obj->type);
        $this->assertInstanceOf(Location::class, $obj->location);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
        $this->assertSame(15, $obj->zoom);
        $this->assertSame(600, $obj->width);
        $this->assertSame(400, $obj->height);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_map_minimal.json');
        $obj = RichBlockMap::fromArray($data);

        $this->assertInstanceOf(RichBlockMap::class, $obj);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_map_full.json');
        $obj = RichBlockMap::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'map'], $obj->toArray());
    }
}
