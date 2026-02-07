<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;


use F4\Pechkin\DataType\{
    AbstractDataType,
    MaybeInaccessibleMessage,
    User,
};

readonly class CallbackQuery extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly User $from,
        public readonly string $chat_instance,
        public readonly ?MaybeInaccessibleMessage $message = null,
        public readonly ?string $inline_message_id = null,
        public readonly ?string $data = null,
        public readonly ?string $game_short_name = null,
    ) {}
}
