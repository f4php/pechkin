<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    Sticker,
};

readonly class Gift extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly Sticker $sticker,
        public readonly int $star_count,
        public readonly ?int $total_count = null,
        public readonly ?int $remaining_count = null,
        public readonly ?int $personal_total_count = null,
        public readonly ?int $personal_remaining_count = null,
        public readonly ?bool $is_premium = null,
        public readonly ?bool $has_colors = null,
        public readonly ?string $colors = null,
        public readonly ?string $background = null,
        public readonly ?int $unique_gift_variant_count = null,
        public readonly ?Chat $publisher_chat = null,
    ) {}
}
