<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    PassportElementError,
    Attribute\ArrayOf,
};

use function in_array;

readonly class PassportElementErrorFiles extends PassportElementError
{
    public readonly string $source;
    public function __construct(
        public readonly string $type,
        /** @var string[] */
        #[ArrayOf('string')]
        public readonly array $file_hashes,
        public readonly string $message,
    ) {
        $this->source = 'files';
        if (!in_array(needle: $this->type, haystack: ['utility_bill', 'bank_statement', 'rental_agreement', 'passport_registration', 'temporary_registration'], strict: true)) {
            throw new InvalidArgumentException('Unsupported ' . __CLASS__ . ' type');
        }
    }
}
