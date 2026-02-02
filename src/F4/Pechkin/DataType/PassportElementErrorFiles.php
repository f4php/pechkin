<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\PassportElementError;

readonly class PassportElementErrorFiles extends PassportElementError
{
    public function __construct(
        public readonly string $source,
        public readonly string $type,
        /** @var string[] */
        public readonly array $file_hashes,
        public readonly string $message,
    ) {}
}
