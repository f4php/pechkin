<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichText,
};

readonly class RichTextDateTime extends RichText
{
    public readonly string $type;
    public function __construct(
        public readonly RichText $text,
        public readonly int $unix_time,
        public readonly string $date_time_format,
    ) {
        $this->type = 'date_time';
    }
}
