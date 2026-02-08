<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\KeyboardButtonRequestUsers;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class KeyboardButtonRequestUsersTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('keyboard_button_request_users_full.json');
        $keyboardButtonRequestUsers = KeyboardButtonRequestUsers::fromArray($data);

        $this->assertInstanceOf(KeyboardButtonRequestUsers::class, $keyboardButtonRequestUsers);
        $this->assertSame(12345, $keyboardButtonRequestUsers->request_id);
        $this->assertSame(false, $keyboardButtonRequestUsers->user_is_bot);
        $this->assertSame(false, $keyboardButtonRequestUsers->user_is_premium);
        $this->assertSame(10, $keyboardButtonRequestUsers->max_quantity);
        $this->assertSame(true, $keyboardButtonRequestUsers->request_name);
        $this->assertSame(true, $keyboardButtonRequestUsers->request_username);
        $this->assertSame(true, $keyboardButtonRequestUsers->request_photo);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('keyboard_button_request_users_minimal.json');
        $keyboardButtonRequestUsers = KeyboardButtonRequestUsers::fromArray($data);

        $this->assertInstanceOf(KeyboardButtonRequestUsers::class, $keyboardButtonRequestUsers);
        $this->assertNull($keyboardButtonRequestUsers->user_is_bot);
        $this->assertNull($keyboardButtonRequestUsers->user_is_premium);
        $this->assertNull($keyboardButtonRequestUsers->max_quantity);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('keyboard_button_request_users_minimal.json');
        $keyboardButtonRequestUsers = KeyboardButtonRequestUsers::fromArray($data);
        $this->assertEquals($data, $keyboardButtonRequestUsers->toArray());
    }
}
