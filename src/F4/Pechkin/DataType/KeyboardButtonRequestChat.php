<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ChatAdministratorRights,
};

readonly class KeyboardButtonRequestChat extends AbstractDataType
{
    public function __construct(
        public readonly int $request_id,
        public readonly bool $chat_is_channel,
        public readonly ?bool $chat_is_forum = null,
        public readonly ?bool $chat_has_username = null,
        public readonly ?bool $chat_is_created = null,
        public readonly ?ChatAdministratorRights $user_administrator_rights = null,
        public readonly ?ChatAdministratorRights $bot_administrator_rights = null,
        public readonly ?bool $bot_is_member = null,
        public readonly ?bool $request_title = null,
        public readonly ?bool $request_username = null,
        public readonly ?bool $request_photo = null,
    ) {}
}
