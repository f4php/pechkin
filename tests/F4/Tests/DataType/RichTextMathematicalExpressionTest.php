<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextMathematicalExpression;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextMathematicalExpressionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_mathematical_expression_full.json');
        $obj = RichTextMathematicalExpression::fromArray($data);

        $this->assertInstanceOf(RichTextMathematicalExpression::class, $obj);
        $this->assertSame('mathematical_expression', $obj->type);
        $this->assertSame('x^2', $obj->expression);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_mathematical_expression_full.json');
        $obj = RichTextMathematicalExpression::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'mathematical_expression'], $obj->toArray());
    }
}
