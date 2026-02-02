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
        public readonly ?KeyboardButtonRequestUsers $request_users = null,
        public readonly ?KeyboardButtonRequestChat $request_chat = null,
        public readonly ?bool $request_contact = null,
        public readonly ?bool $request_location = null,
        public readonly ?KeyboardButtonPollType $request_poll = null,
        public readonly ?WebAppInfo $web_app = null,
    ) {}
}
