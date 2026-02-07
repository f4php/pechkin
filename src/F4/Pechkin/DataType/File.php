<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class File extends AbstractDataType
{
    public function __construct(
        public readonly string $file_id,
        public readonly string $file_unique_id,
        public readonly ?string $file_size = null, // may not fit in a 32-bit integer
        public readonly ?string $file_path = null,
    ) {}
}
