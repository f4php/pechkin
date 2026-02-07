<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BotCommandScope,
};

readonly class BotCommandScopeChatMember extends BotCommandScope
{
    public function __construct(
        public readonly int|string $chat_id,
        public readonly int $user_id,
    ) {}
}
