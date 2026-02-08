<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\MenuButton;
use F4\Pechkin\DataType\MenuButtonCommands;
use F4\Pechkin\DataType\MenuButtonWebApp;
use F4\Pechkin\DataType\MenuButtonDefault;

final class MenuButtonTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithCommandsType(): void
    {
        $data = [
            'type' => 'commands',
        ];
        $result = MenuButton::fromArray($data);
        $this->assertInstanceOf(MenuButtonCommands::class, $result);
    }

    public function testFromArrayWithWebAppType(): void
    {
        $data = [
            ...$this->loadFixture('menu_button_web_app_full.json'),
            'type' => 'web_app',
        ];
        $result = MenuButton::fromArray($data);
        $this->assertInstanceOf(MenuButtonWebApp::class, $result);
    }

    public function testFromArrayWithDefaultType(): void
    {
        $data = [
            'type' => 'default',
        ];
        $result = MenuButton::fromArray($data);
        $this->assertInstanceOf(MenuButtonDefault::class, $result);
    }
}
