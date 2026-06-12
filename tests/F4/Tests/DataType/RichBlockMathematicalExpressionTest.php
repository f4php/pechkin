<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockMathematicalExpression;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockMathematicalExpressionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_mathematical_expression_full.json');
        $obj = RichBlockMathematicalExpression::fromArray($data);

        $this->assertInstanceOf(RichBlockMathematicalExpression::class, $obj);
        $this->assertSame('mathematical_expression', $obj->type);
        $this->assertSame('E=mc^2', $obj->expression);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_mathematical_expression_full.json');
        $obj = RichBlockMathematicalExpression::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'mathematical_expression'], $obj->toArray());
    }
}
