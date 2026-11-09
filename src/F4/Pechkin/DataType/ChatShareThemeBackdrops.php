<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ChatShareThemeBackdrop,
    Attribute\ArrayOf,
};

readonly class ChatShareThemeBackdrops extends AbstractDataType
{
    public function __construct(
        /** @var ChatShareThemeBackdrop[] */
        #[ArrayOf(ChatShareThemeBackdrop::class)]
        public readonly array $backdrops,
    ) {}
}
