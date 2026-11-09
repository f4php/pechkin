<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    MessageEntity,
    RichText,
    Attribute\ArrayOf,
};

readonly class TextQuote extends AbstractDataType
{
    public function __construct(
        public readonly string $text,
        public readonly int $position,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $entities = null, // Special entities that appear in the quote. Currently, only bold, italic, underline, strikethrough, spoiler, custom_emoji, and date_time entities are kept in quotes.
        /** @var array<RichText|RichText[]|string>|null */
        #[ArrayOf(RichText::class)]
        public readonly ?array $rich_texts = null,
        public readonly ?bool $is_manual = null,
    ) {}
}
