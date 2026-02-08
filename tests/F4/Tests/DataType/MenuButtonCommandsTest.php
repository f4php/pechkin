<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\MenuButtonCommands;
use PHPUnit\Framework\TestCase;

final class MenuButtonCommandsTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $menuButtonCommands = MenuButtonCommands::fromArray($data);

        $this->assertInstanceOf(MenuButtonCommands::class, $menuButtonCommands);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $menuButtonCommands = MenuButtonCommands::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'commands'], $menuButtonCommands->toArray());
    }
}
