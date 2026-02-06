<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BotCommandScopeChatMember;

final class BotCommandScopeChatMemberTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data1 = ['chat_id' => 123456789, 'user_id' => '987654321'];
        $scope1 = BotCommandScopeChatMember::fromArray($data1);
        $this->assertSame(123456789, $scope1->chat_id);
        $this->assertSame('987654321', $scope1->user_id);

        $data2 = ['chat_id' => '@supergroupusername', 'user_id' => '987654321'];
        $scope2 = BotCommandScopeChatMember::fromArray($data2);
        $this->assertSame('@supergroupusername', $scope2->chat_id);
        $this->assertSame('987654321', $scope2->user_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = ['chat_id' => -100123456789, 'user_id' => '999888777666'];
        $scope = BotCommandScopeChatMember::fromArray($data);
        $this->assertSame($data, $scope->toArray());
    }
}
