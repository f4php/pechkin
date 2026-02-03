<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PhotoSize,
    Attribute\ArrayOf,
};

readonly class UserProfilePhotos extends AbstractDataType
{
    public function __construct(
        public readonly int $total_count,
        /** @var PhotoSize[][] */
        #[ArrayOf(PhotoSize::class)]
        public readonly array $photos,
    ) {}
}
