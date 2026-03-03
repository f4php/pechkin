<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Audio,
    Attribute\ArrayOf,
};

readonly class UserProfileAudios extends AbstractDataType
{
    public function __construct(
        public readonly int $total_count,
        /** @var Audio[] */
        #[ArrayOf(Audio::class)]
        public readonly array $audios,
    ) {}
}
