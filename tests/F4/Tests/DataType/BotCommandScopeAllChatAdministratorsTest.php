<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BotCommandScopeAllChatAdministrators;

final class BotCommandScopeAllChatAdministratorsTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $scope = BotCommandScopeAllChatAdministrators::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeAllChatAdministrators::class, $scope);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $scope = BotCommandScopeAllChatAdministrators::fromArray($data);
        $this->assertSame($data, $scope->toArray());
    }
}
