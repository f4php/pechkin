<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class ForumTopicEdited extends AbstractDataType
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $icon_custom_emoji_id = null,
    ) {}
}
