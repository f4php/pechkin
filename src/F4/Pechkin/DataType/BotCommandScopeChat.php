<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BotCommandScope,
};

readonly class BotCommandScopeChat extends BotCommandScope
{
    public function __construct(
        public readonly string $type,
        public readonly null|int|string $chat_id,
    ) {}
}
