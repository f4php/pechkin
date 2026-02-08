<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotCommandScopeAllChatAdministrators;
use PHPUnit\Framework\TestCase;

final class BotCommandScopeAllChatAdministratorsTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $botCommandScopeAllChatAdministrators = BotCommandScopeAllChatAdministrators::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeAllChatAdministrators::class, $botCommandScopeAllChatAdministrators);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $botCommandScopeAllChatAdministrators = BotCommandScopeAllChatAdministrators::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'all_chat_administrators'], $botCommandScopeAllChatAdministrators->toArray());
    }
}
