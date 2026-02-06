<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    BotCommandScopeAllChatAdministrators,
    BotCommandScopeAllGroupChats,
    BotCommandScopeAllPrivateChats,
    BotCommandScopeChat,
    BotCommandScopeChatAdministrators,
    BotCommandScopeChatMember,
    BotCommandScopeDefault,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'default' => BotCommandScopeDefault::class,
    'all_private_chats' => BotCommandScopeAllPrivateChats::class,
    'all_group_chats' => BotCommandScopeAllGroupChats::class,
    'all_chat_administrators' => BotCommandScopeAllChatAdministrators::class,
    'chat' => BotCommandScopeChat::class,
    'chat_administrators' => BotCommandScopeChatAdministrators::class,
    'chat_member' => BotCommandScopeChatMember::class,
])]
abstract readonly class BotCommandScope extends AbstractDataType
{
}
