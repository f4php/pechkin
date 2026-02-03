<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InlineKeyboardMarkup,
    InlineQueryResult,
    InputMessageContent,
};

readonly class InlineQueryResultLocation extends InlineQueryResult
{
    public function __construct(
        public readonly string $id,
        public readonly float $latitude,
        public readonly float $longitude,
        public readonly string $title,
        public readonly ?float $horizontal_accuracy = null,
        public readonly ?int $live_period = null,
        public readonly ?int $heading = null,
        public readonly ?int $proximity_alert_radius = null,
        public readonly ?InlineKeyboardMarkup $reply_markup = null,
        public readonly ?InputMessageContent $input_message_content = null,
        public readonly ?string $thumbnail_url = null,
        public readonly ?int $thumbnail_width = null,
        public readonly ?int $thumbnail_height = null,
    ) {}
}
