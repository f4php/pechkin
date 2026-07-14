<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockMathematicalExpression;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockMathematicalExpressionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_mathematical_expression_full.json');
        $obj = InputRichBlockMathematicalExpression::fromArray($data);

        $this->assertInstanceOf(InputRichBlockMathematicalExpression::class, $obj);
        $this->assertSame('mathematical_expression', $obj->type);
        $this->assertSame('E=mc^2', $obj->expression);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_mathematical_expression_full.json');
        $obj = InputRichBlockMathematicalExpression::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'mathematical_expression'], $obj->toArray());
    }
}
