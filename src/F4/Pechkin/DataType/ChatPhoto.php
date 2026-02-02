<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class ChatPhoto extends AbstractDataType
{
    public function __construct(
        public readonly string $small_file_id,
        public readonly string $small_file_unique_id,
        public readonly string $big_file_id,
        public readonly string $big_file_unique_id,
    ) {}
}
