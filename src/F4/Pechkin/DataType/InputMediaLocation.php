<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMedia,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class InputMediaLocation extends InputMedia
{
    public readonly string $type;
    public function __construct(
        public readonly float $latitude,
        public readonly float $longitude,
        public readonly ?float $horizontal_accuracy = null,
    ) {
        $this->type = 'location';
    }
}
