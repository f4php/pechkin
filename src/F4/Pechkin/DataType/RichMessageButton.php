<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\Attribute\ArrayOf;

use F4\Pechkin\DataType\{
    AbstractDataType,
    CopyTextButton,
    DisabledButton,
    LoginUrl,
    RichText,
    SwitchInlineQueryChosenChat,
    WebAppInfo,
};

readonly class RichMessageButton extends AbstractDataType
{
    public function __construct(
        /** @var RichText|RichText[]|string */
        #[ArrayOf(RichText::class)]
        public readonly RichText|array|string $text,
        public readonly ?string $style = null, // Must be one of “danger” (red), “success” (green), “primary” (blue) or “link”. If omitted, then an app-specific style is used.
        public readonly ?string $url = null,
        public readonly ?string $callback_data = null,
        public readonly ?WebAppInfo $web_app = null,
        public readonly ?LoginUrl $login_url = null,
        public readonly ?string $switch_inline_query = null,
        public readonly ?string $switch_inline_query_current_chat = null,
        public readonly ?SwitchInlineQueryChosenChat $switch_inline_query_chosen_chat = null,
        public readonly ?CopyTextButton $copy_text = null,
        public readonly ?DisabledButton $disabled = null,
    ) {}
}
