<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    MessageEntity,
    User,
};

readonly class ChecklistTask extends AbstractDataType
{
    public function __construct(
        public readonly int $id,
        public readonly string $text,
        /** @var MessageEntity[]|null */
        public readonly ?array $text_entities = null,
        public readonly ?User $completed_by_user = null,
        public readonly ?Chat $completed_by_chat = null,
        public readonly ?int $completion_date = null,
    ) {}
}
