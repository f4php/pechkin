<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    ChatShareTheme,
    UniqueGift,
};

readonly class ChatShareThemeUniqueGift extends ChatShareTheme
{
    public readonly string $type;
    public function __construct(
        public readonly UniqueGift $gift,
    ) {
        $this->type = 'unique_gift';
    }
}
