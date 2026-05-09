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
        float $latitude,
        float $longitude,
        ?float $horizontal_accuracy = null,
    ) {
        $this->type = 'location';
    }
}
