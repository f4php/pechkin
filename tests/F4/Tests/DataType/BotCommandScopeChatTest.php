<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BotCommandScopeChat;

final class BotCommandScopeChatTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data1 = ['chat_id' => 123456789];
        $scope1 = BotCommandScopeChat::fromArray($data1);
        $this->assertSame(123456789, $scope1->chat_id);
        $data2 = ['chat_id' => '@supergroupusername'];
        $scope2 = BotCommandScopeChat::fromArray($data2);
        $this->assertSame('@supergroupusername', $scope2->chat_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = ['chat_id' => -100123456789];
        $scope = BotCommandScopeChat::fromArray($data);
        $this->assertSame($data, $scope->toArray());
    }
}
