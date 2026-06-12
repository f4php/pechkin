<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlock;
use F4\Pechkin\DataType\RichBlockListItem;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockListItemTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_list_item_full.json');
        $item = RichBlockListItem::fromArray($data);

        $this->assertInstanceOf(RichBlockListItem::class, $item);
        $this->assertSame('1.', $item->label);
        $this->assertNotEmpty($item->blocks);
        $this->assertInstanceOf(RichBlock::class, $item->blocks[0]);
        $this->assertSame(true, $item->has_checkbox);
        $this->assertSame(false, $item->is_checked);
        $this->assertSame(1, $item->value);
        $this->assertSame('ordered', $item->type);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_list_item_minimal.json');
        $item = RichBlockListItem::fromArray($data);

        $this->assertInstanceOf(RichBlockListItem::class, $item);
        $this->assertNull($item->has_checkbox);
        $this->assertNull($item->is_checked);
        $this->assertNull($item->value);
        $this->assertNull($item->type);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_list_item_minimal.json');
        $item = RichBlockListItem::fromArray($data);
        $this->assertEquals($data, $item->toArray());
    }
}
