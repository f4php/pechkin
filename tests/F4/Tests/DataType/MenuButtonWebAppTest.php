<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\MenuButtonWebApp;
use F4\Pechkin\DataType\WebAppInfo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MenuButtonWebAppTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('menu_button_web_app_full.json');
        $menuButtonWebApp = MenuButtonWebApp::fromArray($data);

        $this->assertInstanceOf(MenuButtonWebApp::class, $menuButtonWebApp);
        $this->assertInstanceOf(WebAppInfo::class, $menuButtonWebApp->web_app);
        $this->assertSame('Hello, World!', $menuButtonWebApp->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('menu_button_web_app_minimal.json');
        $menuButtonWebApp = MenuButtonWebApp::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'web_app'], $menuButtonWebApp->toArray());
    }
}
