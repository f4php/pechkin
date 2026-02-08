<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotCommandScopeAllGroupChats;
use PHPUnit\Framework\TestCase;

final class BotCommandScopeAllGroupChatsTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $botCommandScopeAllGroupChats = BotCommandScopeAllGroupChats::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeAllGroupChats::class, $botCommandScopeAllGroupChats);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $botCommandScopeAllGroupChats = BotCommandScopeAllGroupChats::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'all_group_chats'], $botCommandScopeAllGroupChats->toArray());
    }
}
