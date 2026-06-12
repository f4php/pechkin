<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockBlockQuotation;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockBlockQuotationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_block_quotation_full.json');
        $obj = RichBlockBlockQuotation::fromArray($data);

        $this->assertInstanceOf(RichBlockBlockQuotation::class, $obj);
        $this->assertSame('blockquote', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->credit);
        $this->assertNotEmpty($obj->blocks);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_block_quotation_minimal.json');
        $obj = RichBlockBlockQuotation::fromArray($data);

        $this->assertInstanceOf(RichBlockBlockQuotation::class, $obj);
        $this->assertNull($obj->credit);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_block_quotation_full.json');
        $obj = RichBlockBlockQuotation::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'blockquote'], $obj->toArray());
    }
}
