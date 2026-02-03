<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class TextQuote extends AbstractDataType
{
    public function __construct(
        public readonly string $text,
        public readonly int $position,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $entities = null,
        public readonly ?bool $is_manual = null,
    ) {}
}
