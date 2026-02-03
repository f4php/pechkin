<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class InputChecklistTask extends AbstractDataType
{
    public function __construct(
        public readonly int $id,
        public readonly string $text,
        public readonly ?string $parse_mode = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $text_entities = null,
    ) {}
}
