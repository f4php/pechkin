<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    CallbackGame,
    CopyTextButton,
    LoginUrl,
    SwitchInlineQueryChosenChat,
    WebAppInfo,
};

readonly class InlineKeyboardButton extends AbstractDataType
{
    public function __construct(
        public readonly string $text,
        public readonly ?string $url = null,
        public readonly ?string $callback_data = null,
        public readonly ?WebAppInfo $web_app = null,
        public readonly ?LoginUrl $login_url = null,
        public readonly ?string $switch_inline_query = null,
        public readonly ?string $switch_inline_query_current_chat = null,
        public readonly ?SwitchInlineQueryChosenChat $switch_inline_query_chosen_chat = null,
        public readonly ?CopyTextButton $copy_text = null,
        public readonly ?CallbackGame $callback_game = null,
        public readonly ?bool $pay = null,
    ) {}
}
