<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\AbstractDataType;

use function in_array;

readonly class MaskPosition extends AbstractDataType
{
    public function __construct(
        public readonly string $point,
        public readonly float $x_shift,
        public readonly float $y_shift,
        public readonly float $scale,
    ) {
        if(!in_array(needle: $this->point, haystack: ['forehead', 'eyes', 'mouth', 'chin'], strict: true)) {
            throw new InvalidArgumentException('Unsupported '.__CLASS__.' point');
        }
    }
}
