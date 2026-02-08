<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\CallbackGame;

final class CallbackGameTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $callbackGame = CallbackGame::fromArray($data);

        $this->assertInstanceOf(CallbackGame::class, $callbackGame);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $callbackGame = CallbackGame::fromArray($data);
        $this->assertEquals($data, $callbackGame->toArray());
    }
}
