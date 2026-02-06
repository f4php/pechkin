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
        $game = CallbackGame::fromArray($data);
        $this->assertInstanceOf(CallbackGame::class, $game);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $game = CallbackGame::fromArray($data);
        $this->assertSame($data, $game->toArray());
    }
}
