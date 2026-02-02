<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Sticker,
};

readonly class BusinessIntro extends AbstractDataType
{
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $message = null,
        public readonly ?Sticker $sticker = null,
    ) {}
}
