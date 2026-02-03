<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InlineKeyboardMarkup,
    InlineQueryResult,
    InputMessageContent,
};

readonly class InlineQueryResultVenue extends InlineQueryResult
{
    public function __construct(
        public readonly string $id,
        public readonly float $latitude,
        public readonly float $longitude,
        public readonly string $title,
        public readonly string $address,
        public readonly ?string $foursquare_id = null,
        public readonly ?string $foursquare_type = null,
        public readonly ?string $google_place_id = null,
        public readonly ?string $google_place_type = null,
        public readonly ?InlineKeyboardMarkup $reply_markup = null,
        public readonly ?InputMessageContent $input_message_content = null,
        public readonly ?string $thumbnail_url = null,
        public readonly ?int $thumbnail_width = null,
        public readonly ?int $thumbnail_height = null,
    ) {}
}
