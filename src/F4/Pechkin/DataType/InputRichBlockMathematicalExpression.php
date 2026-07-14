<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\InputRichBlock;

readonly class InputRichBlockMathematicalExpression extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly string $expression,
    ) {
        $this->type = 'mathematical_expression';
    }
}
