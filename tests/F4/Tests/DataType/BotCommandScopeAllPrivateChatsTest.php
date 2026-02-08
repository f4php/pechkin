<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotCommandScopeAllPrivateChats;
use PHPUnit\Framework\TestCase;

final class BotCommandScopeAllPrivateChatsTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $botCommandScopeAllPrivateChats = BotCommandScopeAllPrivateChats::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeAllPrivateChats::class, $botCommandScopeAllPrivateChats);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $botCommandScopeAllPrivateChats = BotCommandScopeAllPrivateChats::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'all_private_chats'], $botCommandScopeAllPrivateChats->toArray());
    }
}
