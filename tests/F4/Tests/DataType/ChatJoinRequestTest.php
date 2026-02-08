<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\ChatInviteLink;
use F4\Pechkin\DataType\ChatJoinRequest;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatJoinRequestTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_join_request_full.json');
        $chatJoinRequest = ChatJoinRequest::fromArray($data);

        $this->assertInstanceOf(ChatJoinRequest::class, $chatJoinRequest);
        $this->assertInstanceOf(Chat::class, $chatJoinRequest->chat);
        $this->assertInstanceOf(User::class, $chatJoinRequest->from);
        $this->assertInstanceOf(ChatInviteLink::class, $chatJoinRequest->invite_link);
        $this->assertSame('123456789', $chatJoinRequest->user_chat_id);
        $this->assertSame(1700000000, $chatJoinRequest->date);
        $this->assertSame('Test bio', $chatJoinRequest->bio);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_join_request_minimal.json');
        $chatJoinRequest = ChatJoinRequest::fromArray($data);

        $this->assertInstanceOf(ChatJoinRequest::class, $chatJoinRequest);
        $this->assertNull($chatJoinRequest->bio);
        $this->assertNull($chatJoinRequest->invite_link);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_join_request_minimal.json');
        $chatJoinRequest = ChatJoinRequest::fromArray($data);
        $this->assertEquals($data, $chatJoinRequest->toArray());
    }
}
