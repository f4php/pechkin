<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PhotoSize,
    Attribute\ArrayOf,
};

readonly class SharedUser extends AbstractDataType
{
    public function __construct(
        public readonly string $user_id, // may not fit in a 32-bit integer
        public readonly ?string $first_name = null,
        public readonly ?string $last_name = null,
        public readonly ?string $username = null,
        /** @var PhotoSize[]|null */
        #[ArrayOf(PhotoSize::class)]
        public readonly ?array $photo = null,
    ) {}
}
