<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\PassportElementError;

use function in_array;

readonly class PassportElementErrorReverseSide extends PassportElementError
{
    public readonly string $source;
    public function __construct(
        public readonly string $type,
        public readonly string $file_hash,
        public readonly string $message,
    ) {
        $this->source = 'reverse_side';
        if (!in_array(needle: $this->type, haystack: ['driver_license', 'identity_card'], strict: true)) {
            throw new InvalidArgumentException('Unsupported ' . __CLASS__ . ' type');
        }
    }
}
