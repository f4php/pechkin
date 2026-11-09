<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class Widget extends AbstractDataType
{
    public function __construct(
        public readonly string $html,
        public readonly ?string $id = null,
        public readonly ?int $width = null,
        public readonly ?int $height = null,
        public readonly ?string $public_data = null,
        public readonly ?string $chat_data = null,
    ) {}
}
