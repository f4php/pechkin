<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotCommandScopeChat;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BotCommandScopeChatTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('bot_command_scope_chat_full.json');
        $botCommandScopeChat = BotCommandScopeChat::fromArray($data);

        $this->assertInstanceOf(BotCommandScopeChat::class, $botCommandScopeChat);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('bot_command_scope_chat_minimal.json');
        $botCommandScopeChat = BotCommandScopeChat::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'chat'], $botCommandScopeChat->toArray());
    }
}
