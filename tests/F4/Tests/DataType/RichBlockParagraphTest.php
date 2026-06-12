<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockParagraph;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockParagraphTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_paragraph_full.json');
        $obj = RichBlockParagraph::fromArray($data);

        $this->assertInstanceOf(RichBlockParagraph::class, $obj);
        $this->assertSame('paragraph', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_paragraph_full.json');
        $obj = RichBlockParagraph::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'paragraph'], $obj->toArray());
    }
}
