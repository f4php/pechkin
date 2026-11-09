<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    ChatShareTheme,
    EmojiType,
    Attribute\ArrayOf,
};

readonly class ChatShareThemeEmoji extends ChatShareTheme
{
    public readonly string $type;
    public function __construct(
        /** @var EmojiType[] */
        #[ArrayOf(EmojiType::class)]
        public readonly array $emojis,
        public readonly ?int $background_backdrop_id = null,
    ) {
        $this->type = 'emoji';
    }
}
