<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InlineKeyboardMarkup,
    InlineQueryResult,
};

readonly class InlineQueryResultGame extends InlineQueryResult
{
    public function __construct(
        public readonly string $type,
        public readonly string $id,
        public readonly string $game_short_name,
        public readonly ?InlineKeyboardMarkup $reply_markup = null,
    ) {}
}
