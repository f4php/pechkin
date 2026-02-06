<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BotCommandScopeAllPrivateChats;

final class BotCommandScopeAllPrivateChatsTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $scope = BotCommandScopeAllPrivateChats::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeAllPrivateChats::class, $scope);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $scope = BotCommandScopeAllPrivateChats::fromArray($data);
        $this->assertSame($data, $scope->toArray());
    }
}
