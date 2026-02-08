<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    PaidMedia,
    PhotoSize,
    Attribute\ArrayOf,
};

readonly class PaidMediaPhoto extends PaidMedia
{
    public readonly string $type;
    public function __construct(
        /** @var PhotoSize[] */
        #[ArrayOf(PhotoSize::class)]
        public readonly array $photo,
    ) {
        $this->type = 'photo';
    }
}
