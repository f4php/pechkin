<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PhotoSize,
};

readonly class UserProfilePhotos extends AbstractDataType
{
    public function __construct(
        public readonly int $total_count,
        /** @var PhotoSize[][] */
        public readonly array $photos,
    ) {}
}
