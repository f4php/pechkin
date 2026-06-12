<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockTable;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockTableTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_table_full.json');
        $obj = RichBlockTable::fromArray($data);

        $this->assertInstanceOf(RichBlockTable::class, $obj);
        $this->assertSame('table', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->caption);
        $this->assertNotEmpty($obj->cells);
        $this->assertSame(true, $obj->is_bordered);
        $this->assertSame(false, $obj->is_striped);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_table_minimal.json');
        $obj = RichBlockTable::fromArray($data);

        $this->assertInstanceOf(RichBlockTable::class, $obj);
        $this->assertNull($obj->is_bordered);
        $this->assertNull($obj->is_striped);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_table_full.json');
        $obj = RichBlockTable::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'table'], $obj->toArray());
    }
}
