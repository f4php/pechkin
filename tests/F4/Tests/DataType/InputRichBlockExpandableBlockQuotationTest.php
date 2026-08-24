<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockExpandableBlockQuotation;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockExpandableBlockQuotationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_expandable_block_quotation_full.json');
        $obj = InputRichBlockExpandableBlockQuotation::fromArray($data);

        $this->assertInstanceOf(InputRichBlockExpandableBlockQuotation::class, $obj);
        $this->assertSame('expandable_blockquote', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertInstanceOf(RichText::class, $obj->credit);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_rich_block_expandable_block_quotation_minimal.json');
        $obj = InputRichBlockExpandableBlockQuotation::fromArray($data);

        $this->assertInstanceOf(InputRichBlockExpandableBlockQuotation::class, $obj);
        $this->assertNull($obj->credit);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_expandable_block_quotation_minimal.json');
        $obj = InputRichBlockExpandableBlockQuotation::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'expandable_blockquote'], $obj->toArray());
    }
}
