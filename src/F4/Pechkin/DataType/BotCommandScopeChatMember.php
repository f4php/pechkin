<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BotCommandScope,
};

readonly class BotCommandScopeChatMember extends BotCommandScope
{
    public function __construct(
        public readonly null|int|string $chat_id,
        public readonly string $user_id, // may not fit in a 32-bit integer
    ) {}
}
