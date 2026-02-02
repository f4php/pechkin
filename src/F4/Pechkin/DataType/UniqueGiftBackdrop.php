<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    BackgroundFill,
};

readonly class UniqueGiftBackdrop extends AbstractDataType
{
    public function __construct(
        public readonly BackgroundFill $fill,
    ) {}
}
