<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlock;
use F4\Pechkin\DataType\RichBlockDivider;
use F4\Pechkin\DataType\RichBlockMathematicalExpression;
use F4\Pechkin\DataType\RichBlockParagraph;
use F4\Pechkin\DataType\RichBlockSectionHeading;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithParagraphType(): void
    {
        $data = [
            ...$this->loadFixture('rich_block_paragraph_full.json'),
            'type' => 'paragraph',
        ];
        $result = RichBlock::fromArray($data);
        $this->assertInstanceOf(RichBlockParagraph::class, $result);
    }

    public function testFromArrayWithSectionHeadingType(): void
    {
        $data = [
            ...$this->loadFixture('rich_block_section_heading_full.json'),
            'type' => 'section_heading',
        ];
        $result = RichBlock::fromArray($data);
        $this->assertInstanceOf(RichBlockSectionHeading::class, $result);
    }

    public function testFromArrayWithMathematicalExpressionType(): void
    {
        $data = [
            ...$this->loadFixture('rich_block_mathematical_expression_full.json'),
            'type' => 'mathematical_expression',
        ];
        $result = RichBlock::fromArray($data);
        $this->assertInstanceOf(RichBlockMathematicalExpression::class, $result);
    }

    public function testFromArrayWithDividerType(): void
    {
        $result = RichBlock::fromArray(['type' => 'divider']);
        $this->assertInstanceOf(RichBlockDivider::class, $result);
    }
}
