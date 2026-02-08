<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BotCommandScope;
use F4\Pechkin\DataType\BotCommandScopeDefault;
use F4\Pechkin\DataType\BotCommandScopeAllPrivateChats;
use F4\Pechkin\DataType\BotCommandScopeAllGroupChats;
use F4\Pechkin\DataType\BotCommandScopeAllChatAdministrators;
use F4\Pechkin\DataType\BotCommandScopeChat;
use F4\Pechkin\DataType\BotCommandScopeChatAdministrators;
use F4\Pechkin\DataType\BotCommandScopeChatMember;

final class BotCommandScopeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithDefaultType(): void
    {
        $data = [
            'type' => 'default',
        ];
        $result = BotCommandScope::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeDefault::class, $result);
    }

    public function testFromArrayWithAllPrivateChatsType(): void
    {
        $data = [
            'type' => 'all_private_chats',
        ];
        $result = BotCommandScope::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeAllPrivateChats::class, $result);
    }

    public function testFromArrayWithAllGroupChatsType(): void
    {
        $data = [
            'type' => 'all_group_chats',
        ];
        $result = BotCommandScope::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeAllGroupChats::class, $result);
    }

    public function testFromArrayWithAllChatAdministratorsType(): void
    {
        $data = [
            'type' => 'all_chat_administrators',
        ];
        $result = BotCommandScope::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeAllChatAdministrators::class, $result);
    }

    public function testFromArrayWithChatType(): void
    {
        $data = [
            ...$this->loadFixture('bot_command_scope_chat_full.json'),
            'type' => 'chat',
        ];
        $result = BotCommandScope::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeChat::class, $result);
    }

    public function testFromArrayWithChatAdministratorsType(): void
    {
        $data = [
            ...$this->loadFixture('bot_command_scope_chat_administrators_full.json'),
            'type' => 'chat_administrators',
        ];
        $result = BotCommandScope::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeChatAdministrators::class, $result);
    }

    public function testFromArrayWithChatMemberType(): void
    {
        $data = [
            ...$this->loadFixture('bot_command_scope_chat_member_full.json'),
            'type' => 'chat_member',
        ];
        $result = BotCommandScope::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeChatMember::class, $result);
    }
    
}
