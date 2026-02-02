<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class LinkPreviewOptions extends AbstractDataType
{
    public function __construct(
        public readonly ?bool $is_disabled = null,
        public readonly ?string $url = null,
        public readonly ?bool $prefer_small_media = null,
        public readonly ?bool $prefer_large_media = null,
        public readonly ?bool $show_above_text = null,
    ) {}
}
