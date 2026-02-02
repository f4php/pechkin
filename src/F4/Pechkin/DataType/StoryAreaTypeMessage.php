<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\StoryAreaType;

readonly class StoryAreaTypeMessage extends StoryAreaType
{
    public function __construct(
        public readonly string $type,
        public readonly string $chat_id, // may not fit in a 32-bit integer
        public readonly int $message_id,
    ) {}
}
