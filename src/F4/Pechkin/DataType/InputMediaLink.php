<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMedia,
};

readonly class InputMediaLink extends InputMedia
{
    public readonly string $type;
    public function __construct(
        public readonly string $url,
    ) {
        $this->type = 'link';
    }
}
