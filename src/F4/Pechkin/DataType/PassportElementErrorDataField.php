<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\PassportElementError;

readonly class PassportElementErrorDataField extends PassportElementError
{
    public function __construct(
        public readonly string $source,
        public readonly string $type,
        public readonly string $field_name,
        public readonly string $data_hash,
        public readonly string $message,
    ) {}
}
