<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    MessageEntity,
};

readonly class InputPollOption extends AbstractDataType
{
    public function __construct(
        public readonly string $text,
        public readonly ?string $text_parse_mode = null,
        /** @var MessageEntity[]|null */
        public readonly ?array $text_entities = null,
    ) {}
}
