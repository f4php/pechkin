<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatAdministratorRights;
use F4\Pechkin\DataType\KeyboardButtonRequestChat;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class KeyboardButtonRequestChatTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('keyboard_button_request_chat_full.json');
        $keyboardButtonRequestChat = KeyboardButtonRequestChat::fromArray($data);

        $this->assertInstanceOf(KeyboardButtonRequestChat::class, $keyboardButtonRequestChat);
        $this->assertInstanceOf(ChatAdministratorRights::class, $keyboardButtonRequestChat->user_administrator_rights);
        $this->assertInstanceOf(ChatAdministratorRights::class, $keyboardButtonRequestChat->bot_administrator_rights);
        $this->assertSame(12345, $keyboardButtonRequestChat->request_id);
        $this->assertSame(false, $keyboardButtonRequestChat->chat_is_channel);
        $this->assertSame(false, $keyboardButtonRequestChat->chat_is_forum);
        $this->assertSame(false, $keyboardButtonRequestChat->chat_has_username);
        $this->assertSame(false, $keyboardButtonRequestChat->chat_is_created);
        $this->assertSame(true, $keyboardButtonRequestChat->bot_is_member);
        $this->assertSame(true, $keyboardButtonRequestChat->request_title);
        $this->assertSame(true, $keyboardButtonRequestChat->request_username);
        $this->assertSame(true, $keyboardButtonRequestChat->request_photo);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('keyboard_button_request_chat_minimal.json');
        $keyboardButtonRequestChat = KeyboardButtonRequestChat::fromArray($data);

        $this->assertInstanceOf(KeyboardButtonRequestChat::class, $keyboardButtonRequestChat);
        $this->assertNull($keyboardButtonRequestChat->chat_is_forum);
        $this->assertNull($keyboardButtonRequestChat->chat_has_username);
        $this->assertNull($keyboardButtonRequestChat->chat_is_created);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('keyboard_button_request_chat_minimal.json');
        $keyboardButtonRequestChat = KeyboardButtonRequestChat::fromArray($data);
        $this->assertEquals($data, $keyboardButtonRequestChat->toArray());
    }
}
