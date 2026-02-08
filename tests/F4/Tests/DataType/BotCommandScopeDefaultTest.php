<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotCommandScopeDefault;
use PHPUnit\Framework\TestCase;

final class BotCommandScopeDefaultTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $botCommandScopeDefault = BotCommandScopeDefault::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeDefault::class, $botCommandScopeDefault);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $botCommandScopeDefault = BotCommandScopeDefault::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'default'], $botCommandScopeDefault->toArray());
    }
}
