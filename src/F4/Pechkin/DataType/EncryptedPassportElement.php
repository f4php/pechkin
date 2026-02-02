<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PassportFile,
};

readonly class EncryptedPassportElement extends AbstractDataType
{
    public function __construct(
        public readonly string $type,
        public readonly string $hash,
        public readonly ?string $data = null,
        public readonly ?string $phone_number = null,
        public readonly ?string $email = null,
        /** @var PassportFile[]|null */
        public readonly ?array $files = null,
        public readonly ?PassportFile $front_side = null,
        public readonly ?PassportFile $reverse_side = null,
        public readonly ?PassportFile $selfie = null,
        /** @var PassportFile[]|null */
        public readonly ?array $translation = null,
    ) {}
}
