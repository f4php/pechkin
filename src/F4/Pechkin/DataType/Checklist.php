<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ChecklistTask,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class Checklist extends AbstractDataType
{
    public function __construct(
        public readonly string $title,
        /** @var ChecklistTask[] */
        #[ArrayOf(ChecklistTask::class)]
        public readonly array $tasks,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $title_entities = null,
        public readonly ?bool $others_can_add_tasks = null,
        public readonly ?bool $others_can_mark_tasks_as_done = null,
    ) {}
}
