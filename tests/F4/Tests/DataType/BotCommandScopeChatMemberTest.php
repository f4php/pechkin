<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotCommandScopeChatMember;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BotCommandScopeChatMemberTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('bot_command_scope_chat_member_full.json');
        $botCommandScopeChatMember = BotCommandScopeChatMember::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeChatMember::class, $botCommandScopeChatMember);
        $this->assertSame(987654321, $botCommandScopeChatMember->user_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('bot_command_scope_chat_member_minimal.json');
        $botCommandScopeChatMember = BotCommandScopeChatMember::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'chat_member'], $botCommandScopeChatMember->toArray());
    }
}
