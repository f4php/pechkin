<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\RichText;

readonly class RichTextMathematicalExpression extends RichText
{
    public readonly string $type;
    public function __construct(
        public readonly string $expression, // in LaTeX format
    ) {
        $this->type = 'mathematical_expression';
    }
}
