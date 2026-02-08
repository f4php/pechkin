<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotCommandScopeChatAdministrators;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BotCommandScopeChatAdministratorsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('bot_command_scope_chat_administrators_full.json');
        $botCommandScopeChatAdministrators = BotCommandScopeChatAdministrators::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeChatAdministrators::class, $botCommandScopeChatAdministrators);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('bot_command_scope_chat_administrators_minimal.json');
        $botCommandScopeChatAdministrators = BotCommandScopeChatAdministrators::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'chat_administrators'], $botCommandScopeChatAdministrators->toArray());
    }
}
