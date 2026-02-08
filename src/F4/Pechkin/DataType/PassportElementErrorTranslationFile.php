<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\PassportElementError;

use function in_array;

readonly class PassportElementErrorTranslationFile extends PassportElementError
{
    public readonly string $source;
    public function __construct(
        public readonly string $type,
        public readonly string $file_hash,
        public readonly string $message,
    ) {
        $this->source = 'translation_file';
        if (!in_array(needle: $this->type, haystack: ['passport', 'driver_license', 'identity_card', 'internal_passport', 'utility_bill', 'bank_statement', 'rental_agreement', 'passport_registration', 'temporary_registration'], strict: true)) {
            throw new InvalidArgumentException('Unsupported ' . __CLASS__ . ' type');
        }
    }
}
