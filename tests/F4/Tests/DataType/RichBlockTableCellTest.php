<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockTableCell;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockTableCellTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_table_cell_full.json');
        $cell = RichBlockTableCell::fromArray($data);

        $this->assertInstanceOf(RichBlockTableCell::class, $cell);
        $this->assertSame('center', $cell->align);
        $this->assertSame('middle', $cell->valign);
        $this->assertInstanceOf(RichText::class, $cell->text);
        $this->assertSame(true, $cell->is_header);
        $this->assertSame(2, $cell->colspan);
        $this->assertSame(1, $cell->rowspan);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_table_cell_minimal.json');
        $cell = RichBlockTableCell::fromArray($data);

        $this->assertInstanceOf(RichBlockTableCell::class, $cell);
        $this->assertNull($cell->text);
        $this->assertNull($cell->is_header);
        $this->assertNull($cell->colspan);
        $this->assertNull($cell->rowspan);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_table_cell_minimal.json');
        $cell = RichBlockTableCell::fromArray($data);
        $this->assertEquals($data, $cell->toArray());
    }
}
