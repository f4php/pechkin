<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\KeyboardButton;
use F4\Pechkin\DataType\KeyboardButtonPollType;
use F4\Pechkin\DataType\KeyboardButtonRequestChat;
use F4\Pechkin\DataType\KeyboardButtonRequestUsers;
use F4\Pechkin\DataType\WebAppInfo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class KeyboardButtonTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('keyboard_button_full.json');
        $keyboardButton = KeyboardButton::fromArray($data);

        $this->assertInstanceOf(KeyboardButton::class, $keyboardButton);
        $this->assertInstanceOf(KeyboardButtonRequestUsers::class, $keyboardButton->request_users);
        $this->assertInstanceOf(KeyboardButtonRequestChat::class, $keyboardButton->request_chat);
        $this->assertInstanceOf(KeyboardButtonPollType::class, $keyboardButton->request_poll);
        $this->assertInstanceOf(WebAppInfo::class, $keyboardButton->web_app);
        $this->assertSame('Hello, World!', $keyboardButton->text);
        $this->assertSame(true, $keyboardButton->request_contact);
        $this->assertSame(true, $keyboardButton->request_location);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('keyboard_button_minimal.json');
        $keyboardButton = KeyboardButton::fromArray($data);

        $this->assertInstanceOf(KeyboardButton::class, $keyboardButton);
        $this->assertNull($keyboardButton->request_users);
        $this->assertNull($keyboardButton->request_chat);
        $this->assertNull($keyboardButton->request_contact);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('keyboard_button_minimal.json');
        $keyboardButton = KeyboardButton::fromArray($data);
        $this->assertEquals($data, $keyboardButton->toArray());
    }
}
