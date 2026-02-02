<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class SuggestedPostParameters extends AbstractDataType
{
    public function __construct(
        public readonly ?bool $allow_user_chats = null,
        public readonly ?bool $allow_bot_chats = null,
        public readonly ?bool $allow_group_chats = null,
        public readonly ?bool $allow_channel_chats = null,
    ) {}
}
