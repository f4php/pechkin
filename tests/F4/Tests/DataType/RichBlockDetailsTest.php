<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockDetails;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockDetailsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_details_full.json');
        $obj = RichBlockDetails::fromArray($data);

        $this->assertInstanceOf(RichBlockDetails::class, $obj);
        $this->assertSame('details', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->summary);
        $this->assertNotEmpty($obj->blocks);
        $this->assertSame(true, $obj->is_open);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_details_minimal.json');
        $obj = RichBlockDetails::fromArray($data);

        $this->assertInstanceOf(RichBlockDetails::class, $obj);
        $this->assertNull($obj->is_open);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_details_full.json');
        $obj = RichBlockDetails::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'details'], $obj->toArray());
    }
}
