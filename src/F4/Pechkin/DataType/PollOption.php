<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class PollOption extends AbstractDataType
{
    public function __construct(
        public readonly string $text,
        public readonly int $voter_count,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $text_entities = null,
    ) {}
}
