<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\MessageOrigin;
use F4\Pechkin\DataType\MessageOriginUser;
use F4\Pechkin\DataType\MessageOriginHiddenUser;
use F4\Pechkin\DataType\MessageOriginChat;
use F4\Pechkin\DataType\MessageOriginChannel;

final class MessageOriginTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithUserType(): void
    {
        $data = [
            ...$this->loadFixture('message_origin_user_full.json'),
            'type' => 'user',
        ];
        $result = MessageOrigin::fromArray($data);
        $this->assertInstanceOf(MessageOriginUser::class, $result);
    }

    public function testFromArrayWithHiddenUserType(): void
    {
        $data = [
            ...$this->loadFixture('message_origin_hidden_user_full.json'),
            'type' => 'hidden_user',
        ];
        $result = MessageOrigin::fromArray($data);
        $this->assertInstanceOf(MessageOriginHiddenUser::class, $result);
    }

    public function testFromArrayWithChatType(): void
    {
        $data = [
            ...$this->loadFixture('message_origin_chat_full.json'),
            'type' => 'chat',
        ];
        $result = MessageOrigin::fromArray($data);
        $this->assertInstanceOf(MessageOriginChat::class, $result);
    }

    public function testFromArrayWithChannelType(): void
    {
        $data = [
            ...$this->loadFixture('message_origin_channel_full.json'),
            'type' => 'channel',
        ];
        $result = MessageOrigin::fromArray($data);
        $this->assertInstanceOf(MessageOriginChannel::class, $result);
    }
}
