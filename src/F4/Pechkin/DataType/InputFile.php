<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class InputFile extends AbstractDataType
{
    public function __construct(
        public readonly string $file_path,
    ) {}
}
