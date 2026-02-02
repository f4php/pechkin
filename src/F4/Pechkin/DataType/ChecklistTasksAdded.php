<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ChecklistTask,
    Message,
};

readonly class ChecklistTasksAdded extends AbstractDataType
{
    public function __construct(
        /** @var ChecklistTask[] */
        public readonly array $tasks,
        public readonly ?Message $checklist_message = null,
    ) {}
}
