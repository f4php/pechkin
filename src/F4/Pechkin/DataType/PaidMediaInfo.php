<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PaidMedia,
    Attribute\ArrayOf,
};

readonly class PaidMediaInfo extends AbstractDataType
{
    public function __construct(
        public readonly int $star_count,
        /** @var PaidMedia[] */
        #[ArrayOf(PaidMedia::class)]
        public readonly array $paid_media,
    ) {}
}
