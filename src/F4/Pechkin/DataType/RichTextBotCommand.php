<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichText,
};

readonly class RichTextBotCommand extends RichText
{
    public readonly string $type;
    public function __construct(
        public readonly RichText $text,
        public readonly string $bot_command,
    ) {
        $this->type = 'bot_command';
    }
}
