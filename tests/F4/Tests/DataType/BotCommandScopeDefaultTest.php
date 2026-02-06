<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BotCommandScopeDefault;

final class BotCommandScopeDefaultTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $scope = BotCommandScopeDefault::fromArray($data);
        $this->assertInstanceOf(BotCommandScopeDefault::class, $scope);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $scope = BotCommandScopeDefault::fromArray($data);
        $this->assertSame($data, $scope->toArray());
    }
}
