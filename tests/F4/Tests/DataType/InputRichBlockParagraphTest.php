<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockParagraph;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockParagraphTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_paragraph_full.json');
        $obj = InputRichBlockParagraph::fromArray($data);

        $this->assertInstanceOf(InputRichBlockParagraph::class, $obj);
        $this->assertSame('paragraph', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_paragraph_full.json');
        $obj = InputRichBlockParagraph::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'paragraph'], $obj->toArray());
    }
}
