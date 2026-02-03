<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    EncryptedCredentials,
    EncryptedPassportElement,
    Attribute\ArrayOf,
};

readonly class PassportData extends AbstractDataType
{
    public function __construct(
        /** @var EncryptedPassportElement[] */
        #[ArrayOf(EncryptedPassportElement::class)]
        public readonly array $data,
        public readonly EncryptedCredentials $credentials,
    ) {}
}
