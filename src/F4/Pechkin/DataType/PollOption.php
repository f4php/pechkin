<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    MessageEntity,
    User,
    Attribute\ArrayOf,
};

readonly class PollOption extends AbstractDataType
{
    public function __construct(
        public readonly string $persistent_id,
        public readonly string $text,
        public readonly int $voter_count,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $text_entities = null,
        public readonly ?User $added_by_user = null,
        public readonly ?Chat $added_by_chat = null,
        public readonly ?int $addition_date = null,
    ) {}
}
