<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\MessageOriginChat;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MessageOriginChatTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('message_origin_chat_full.json');
        $messageOriginChat = MessageOriginChat::fromArray($data);

        $this->assertInstanceOf(MessageOriginChat::class, $messageOriginChat);
        $this->assertInstanceOf(Chat::class, $messageOriginChat->sender_chat);
        $this->assertSame(1700000000, $messageOriginChat->date);
        $this->assertSame('Author', $messageOriginChat->author_signature);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('message_origin_chat_minimal.json');
        $messageOriginChat = MessageOriginChat::fromArray($data);

        $this->assertInstanceOf(MessageOriginChat::class, $messageOriginChat);
        $this->assertNull($messageOriginChat->author_signature);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('message_origin_chat_minimal.json');
        $messageOriginChat = MessageOriginChat::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'chat'], $messageOriginChat->toArray());
    }
}
