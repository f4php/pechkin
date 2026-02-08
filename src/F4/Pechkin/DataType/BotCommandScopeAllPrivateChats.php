<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BotCommandScope,
};

readonly class BotCommandScopeAllPrivateChats extends BotCommandScope
{
    public readonly string $type;
    public function __construct(
        // no data in API docs
    ) {
        $this->type = 'all_private_chats';
    }
}
