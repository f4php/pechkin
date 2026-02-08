<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\MessageOriginChannel;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MessageOriginChannelTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('message_origin_channel_full.json');
        $messageOriginChannel = MessageOriginChannel::fromArray($data);

        $this->assertInstanceOf(MessageOriginChannel::class, $messageOriginChannel);
        $this->assertInstanceOf(Chat::class, $messageOriginChannel->chat);
        $this->assertSame(1700000000, $messageOriginChannel->date);
        $this->assertSame(42, $messageOriginChannel->message_id);
        $this->assertSame('Author', $messageOriginChannel->author_signature);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('message_origin_channel_minimal.json');
        $messageOriginChannel = MessageOriginChannel::fromArray($data);

        $this->assertInstanceOf(MessageOriginChannel::class, $messageOriginChannel);
        $this->assertNull($messageOriginChannel->author_signature);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('message_origin_channel_minimal.json');
        $messageOriginChannel = MessageOriginChannel::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'channel'], $messageOriginChannel->toArray());
    }
}
