<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\PassportElementError;

readonly class PassportElementErrorUnspecified extends PassportElementError
{
    public readonly string $source;
    public function __construct(
        public readonly string $type,
        public readonly string $element_hash,
        public readonly string $message,
    ) {
        $this->source = 'unspecified';
    }
}
