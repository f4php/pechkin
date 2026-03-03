<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    KeyboardButtonPollType,
    KeyboardButtonRequestChat,
    KeyboardButtonRequestUsers,
    WebAppInfo,
};

readonly class KeyboardButton extends AbstractDataType
{
    public function __construct(
        public readonly string $text,
        public readonly ?string $icon_custom_emoji_id = null,
        public readonly ?string $style = null, // Must be one of “danger” (red), “success” (green) or “primary” (blue). If omitted, then an app-specific style is used.
        public readonly ?KeyboardButtonRequestUsers $request_users = null,
        public readonly ?KeyboardButtonRequestChat $request_chat = null,
        public readonly ?bool $request_contact = null,
        public readonly ?bool $request_location = null,
        public readonly ?KeyboardButtonPollType $request_poll = null,
        public readonly ?WebAppInfo $web_app = null,
    ) {}
}
