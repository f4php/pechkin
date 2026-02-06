<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    AcceptedGiftTypes,
};

readonly class GiftSettings extends AbstractDataType
{
    public function __construct(
        public readonly bool $show_gift_button,
        public readonly AcceptedGiftTypes $accepted_gift_types,
    ) {}
}
