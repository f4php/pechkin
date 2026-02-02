<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Gift,
};

readonly class GiftInfo extends AbstractDataType
{
    public function __construct(
        public readonly Gift $gift,
        public readonly bool $is_upgrade_separate,
        public readonly ?string $sticker_color = null,
        public readonly ?int $unique_gift_number = null,
    ) {}
}
