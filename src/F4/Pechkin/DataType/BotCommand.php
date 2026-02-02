<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class BotCommand extends AbstractDataType
{
    public function __construct(
        public readonly string $command,
        public readonly string $description,
    ) {}
}
