<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PhotoSize,
};

readonly class Document extends AbstractDataType
{
    public function __construct(
        public readonly string $file_id,
        public readonly string $file_unique_id,
        public readonly ?PhotoSize $thumbnail = null,
        public readonly ?string $file_name = null,
        public readonly ?string $mime_type = null,
        public readonly ?string $file_size = null,
    ) {}
}
