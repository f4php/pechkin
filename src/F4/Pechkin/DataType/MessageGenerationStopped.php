<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
};

readonly class MessageGenerationStopped extends AbstractDataType
{
    public function __construct(
        public readonly Chat $chat,
        public readonly int $draft_id,
        public readonly ?int $message_thread_id = null,
    ) {}
}
