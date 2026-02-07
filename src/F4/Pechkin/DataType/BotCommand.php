<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\AbstractDataType;

use function 
    mb_strlen,
    preg_match;

readonly class BotCommand extends AbstractDataType
{
    public function __construct(
        public readonly string $command,
        public readonly string $description,
    ) {
        if (mb_strlen($this->command) > 32) {
            throw new InvalidArgumentException('Command length cannot exceed 32 characters');
        }
        if (0 === preg_match('~[a-z0-9_]+~', $this->command)) {
            throw new InvalidArgumentException('Invalid command syntax');
        }
        if (mb_strlen($this->description) > 256) {
            throw new InvalidArgumentException('Description length cannot exceed 32 characters');
        }
    }
}
