<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMessageContent,
    MessageEntity,
    LinkPreviewOptions,
};

readonly class InputTextMessageContent extends InputMessageContent
{
    public function __construct(
        public readonly string $message_text,
        public readonly ?string $parse_mode = null,
        /** @var MessageEntity[]|null */
        public readonly ?array $entities = null,
        public readonly ?LinkPreviewOptions $link_preview_options = null,
    ) {}
}
