<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
};

use function in_array;

readonly class MessageEntity extends AbstractDataType
{
    public function __construct(
        public readonly string $type,
        public readonly int $offset, // UTF-16 code units
        public readonly int $length, // UTF-16 code units
        public readonly ?string $url = null, // for "text_link"
        public readonly ?User $user = null, // for "text_mention"
        public readonly ?string $language = null, // for "pre"
        public readonly ?string $custom_emoji_id = null, // for "custom_emoji"
    ) {
        if(!in_array(needle: $this->type, haystack: ['mention', 'hashtag', 'cashtag', 'bot_command', 'url', 'email', 'phone_number', 'bold', 'italic', 'underline', 'strikethrough', 'spolier', 'blockquote', 'expandable_blockquote', 'code', 'pre', 'text_link', 'text_mention', 'custom_emoji'], strict: true)) {
            throw new InvalidArgumentException('Unsupported '.__CLASS__.' type');
        }
    }
}
