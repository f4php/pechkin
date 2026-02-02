<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    PaidMedia,
    PhotoSize,
};

readonly class PaidMediaPhoto extends PaidMedia
{
    public function __construct(
        public readonly string $type,
        /** @var PhotoSize[] */
        public readonly array $photo,
    ) {}
}
