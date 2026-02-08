<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\MenuButtonDefault;
use PHPUnit\Framework\TestCase;

final class MenuButtonDefaultTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $menuButtonDefault = MenuButtonDefault::fromArray($data);
        $this->assertInstanceOf(MenuButtonDefault::class, $menuButtonDefault);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $menuButtonDefault = MenuButtonDefault::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'default'], $menuButtonDefault->toArray());
    }
}
