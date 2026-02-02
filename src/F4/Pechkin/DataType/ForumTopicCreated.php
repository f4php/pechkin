<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class ForumTopicCreated extends AbstractDataType
{
    public function __construct(
        public readonly string $name,
        public readonly int $icon_color,
        public readonly ?string $icon_custom_emoji_id = null,
        public readonly ?bool $is_name_implicit = null,
    ) {}
}
