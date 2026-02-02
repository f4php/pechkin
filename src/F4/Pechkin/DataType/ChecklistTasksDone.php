<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Message,
};

readonly class ChecklistTasksDone extends AbstractDataType
{
    public function __construct(
        public readonly ?Message $checklist_message = null,
        /** @var int[]|null */
        public readonly ?array $marked_as_done_task_ids = null,
        /** @var int[]|null */
        public readonly ?array $marked_as_not_done_task_ids = null,
    ) {}
}
