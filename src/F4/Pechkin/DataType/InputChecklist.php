<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputChecklistTask,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class InputChecklist extends AbstractDataType
{
    public function __construct(
        public readonly string $title,
        /** @var InputChecklistTask[] */
        #[ArrayOf(InputChecklistTask::class)]
        public readonly array $tasks,
        public readonly ?string $parse_mode = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $title_entities = null,
        public readonly ?bool $others_can_add_tasks = null,
        public readonly ?bool $others_can_mark_tasks_as_done = null,
    ) {}
}
