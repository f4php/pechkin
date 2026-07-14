<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockList;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockListTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_list_full.json');
        $obj = InputRichBlockList::fromArray($data);

        $this->assertInstanceOf(InputRichBlockList::class, $obj);
        $this->assertSame('list', $obj->type);
        $this->assertNotEmpty($obj->items);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_list_full.json');
        $obj = InputRichBlockList::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'list'], $obj->toArray());
    }
}
