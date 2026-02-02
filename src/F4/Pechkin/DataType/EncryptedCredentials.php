<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class EncryptedCredentials extends AbstractDataType
{
    public function __construct(
        public readonly string $data,
        public readonly string $hash,
        public readonly string $secret,
    ) {}
}
