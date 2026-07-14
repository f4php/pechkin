<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockPullQuotation;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockPullQuotationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_pull_quotation_full.json');
        $obj = InputRichBlockPullQuotation::fromArray($data);

        $this->assertInstanceOf(InputRichBlockPullQuotation::class, $obj);
        $this->assertSame('pullquote', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertInstanceOf(RichText::class, $obj->credit);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_rich_block_pull_quotation_minimal.json');
        $obj = InputRichBlockPullQuotation::fromArray($data);

        $this->assertInstanceOf(InputRichBlockPullQuotation::class, $obj);
        $this->assertNull($obj->credit);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_pull_quotation_full.json');
        $obj = InputRichBlockPullQuotation::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'pullquote'], $obj->toArray());
    }
}
