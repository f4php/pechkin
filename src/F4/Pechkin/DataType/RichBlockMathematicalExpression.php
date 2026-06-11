<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\RichBlock;

readonly class RichBlockMathematicalExpression extends RichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly string $expression,
    ) {
        $this->type = 'mathematical_expression';
    }
}
