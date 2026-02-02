<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    BotCommandScope,
};

readonly class BotCommandScopeAllPrivateChats extends BotCommandScope
{
    public function __construct(
        public readonly string $type,
    ) {}
}
