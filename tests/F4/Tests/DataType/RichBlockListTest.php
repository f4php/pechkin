<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockList;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockListTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_list_full.json');
        $obj = RichBlockList::fromArray($data);

        $this->assertInstanceOf(RichBlockList::class, $obj);
        $this->assertSame('list', $obj->type);
        $this->assertNotEmpty($obj->items);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_list_full.json');
        $obj = RichBlockList::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'list'], $obj->toArray());
    }
}
