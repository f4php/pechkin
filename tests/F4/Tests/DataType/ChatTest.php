<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_full.json');
        $chat = Chat::fromArray($data);

        $this->assertInstanceOf(Chat::class, $chat);
        $this->assertSame('123456789', $chat->id);
        $this->assertSame('private', $chat->type);
        $this->assertSame('Test Title', $chat->title);
        $this->assertSame('johndoe', $chat->username);
        $this->assertSame('John', $chat->first_name);
        $this->assertSame('Doe', $chat->last_name);
        $this->assertSame(false, $chat->is_forum);
        $this->assertSame(false, $chat->is_direct_messages);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_minimal.json');
        $chat = Chat::fromArray($data);

        $this->assertInstanceOf(Chat::class, $chat);
        $this->assertNull($chat->title);
        $this->assertNull($chat->username);
        $this->assertNull($chat->first_name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_minimal.json');
        $chat = Chat::fromArray($data);
        $this->assertEquals($data, $chat->toArray());
    }
}
