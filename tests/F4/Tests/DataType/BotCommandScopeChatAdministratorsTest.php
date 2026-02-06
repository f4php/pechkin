<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BotCommandScopeChatAdministrators;

final class BotCommandScopeChatAdministratorsTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = ['chat_id' => 123456789];
        $scope = BotCommandScopeChatAdministrators::fromArray($data);
        $this->assertSame(123456789, $scope->chat_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = ['chat_id' => -100123456789];
        $scope = BotCommandScopeChatAdministrators::fromArray($data);
        $this->assertSame($data, $scope->toArray());
    }
}
