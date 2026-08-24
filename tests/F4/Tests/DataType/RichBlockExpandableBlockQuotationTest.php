<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockExpandableBlockQuotation;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockExpandableBlockQuotationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_expandable_block_quotation_full.json');
        $obj = RichBlockExpandableBlockQuotation::fromArray($data);

        $this->assertInstanceOf(RichBlockExpandableBlockQuotation::class, $obj);
        $this->assertSame('expandable_blockquote', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertInstanceOf(RichText::class, $obj->credit);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_expandable_block_quotation_minimal.json');
        $obj = RichBlockExpandableBlockQuotation::fromArray($data);

        $this->assertInstanceOf(RichBlockExpandableBlockQuotation::class, $obj);
        $this->assertNull($obj->credit);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_expandable_block_quotation_minimal.json');
        $obj = RichBlockExpandableBlockQuotation::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'expandable_blockquote'], $obj->toArray());
    }
}
