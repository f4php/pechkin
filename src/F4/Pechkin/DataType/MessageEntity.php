<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
};

readonly class MessageEntity extends AbstractDataType
{
    public function __construct(
        /**
         * Type of the entity. Currently, can be
         * “mention” (@username),
         * “hashtag” (#hashtag or #hashtag@chatusername),
         * “cashtag” ($USD or $USD@chatusername),
         * “bot_command” (/start@jobs_bot),
         * “url” (https://telegram.org),
         * “email” (do-not-reply@telegram.org),
         * “phone_number” (+1-212-555-0123),
         * “bold” (bold text),
         * “italic” (italic text),
         * “underline” (underlined text),
         * “strikethrough” (strikethrough text),
         * “spoiler” (spoiler message),
         * “blockquote” (block quotation),
         * “expandable_blockquote” (collapsed-by-default block quotation),
         * “code” (monowidth string),
         * “pre” (monowidth block),
         * “text_link” (for clickable text URLs),
         * “text_mention” (for users without usernames),
         * “custom_emoji” (for inline custom emoji stickers)
         */
        public readonly string $type,
        public readonly int $offset, // UTF-16 code units
        public readonly int $length, // UTF-16 code units
        public readonly ?string $url = null, // for "text_link"
        public readonly ?User $user = null, // for "text_mention"
        public readonly ?string $language = null, // for "pre"
        public readonly ?string $custom_emoji_id = null, // for "custom_emoji"
    ) {}
}
