<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\KeyboardButtonRequestManagedBot;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class KeyboardButtonRequestManagedBotTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('keyboard_button_request_managed_bot_full.json');
        $kb = KeyboardButtonRequestManagedBot::fromArray($data);

        $this->assertInstanceOf(KeyboardButtonRequestManagedBot::class, $kb);
        $this->assertSame(7, $kb->request_id);
        $this->assertSame('My Bot', $kb->suggested_name);
        $this->assertSame('mybot', $kb->suggested_username);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('keyboard_button_request_managed_bot_minimal.json');
        $kb = KeyboardButtonRequestManagedBot::fromArray($data);

        $this->assertInstanceOf(KeyboardButtonRequestManagedBot::class, $kb);
        $this->assertNull($kb->suggested_name);
        $this->assertNull($kb->suggested_username);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('keyboard_button_request_managed_bot_minimal.json');
        $kb = KeyboardButtonRequestManagedBot::fromArray($data);
        $this->assertEquals($data, $kb->toArray());
    }
}
