<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

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
            'type' => 'chat',
            'chat_id' => -1001234567890,
        ];
        $result = BotCommandScope::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeChat::class, $result);
        $this->assertSame(-1001234567890, $result->chat_id);
    }

    public function testFromArrayWithChatAdministratorsType(): void
    {
        $data = [
            'type' => 'chat_administrators',
            'chat_id' => -1001234567890,
        ];
        $result = BotCommandScope::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeChatAdministrators::class, $result);
        $this->assertSame(-1001234567890, $result->chat_id);
    }

    public function testFromArrayWithChatMemberType(): void
    {
        $data = [
            'type' => 'chat_member',
            'chat_id' => -1001234567890,
            'user_id' => 123456789,
        ];
        $result = BotCommandScope::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeChatMember::class, $result);
        $this->assertSame(-1001234567890, $result->chat_id);
        $this->assertSame(123456789, $result->user_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'type' => 'chat_member',
            'chat_id' => -1001234567890,
            'user_id' => '123456789',
        ];
        $result = BotCommandScope::fromArray($data);
        unset($data['type']);
        $this->assertSame($data, $result->toArray());
    }
}
