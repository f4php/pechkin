<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\ChatJoinRequest;
use F4\Pechkin\DataType\ChatInviteLink;
use F4\Pechkin\DataType\User;

final class ChatJoinRequestTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'chat' => ['id' => '123', 'type' => 'supergroup'],
            'from' => ['id' => '456', 'is_bot' => false, 'first_name' => 'Requester'],
            'user_chat_id' => '789012345678',
            'date' => 1700000000,
            'bio' => 'test bio',
            'invite_link' => [
                'invite_link' => 'https://t.me/joinchat/abc123',
                'creator' => ['id' => '456', 'is_bot' => false, 'first_name' => 'Admin'],
                'creates_join_request' => true,
                'is_primary' => true,
                'is_revoked' => false,
            ]
        ];
        $request = ChatJoinRequest::fromArray($data);
        $this->assertInstanceOf(Chat::class, $request->chat);
        $this->assertInstanceOf(User::class, $request->from);
        $this->assertSame('789012345678', $request->user_chat_id);
        $this->assertSame('test bio', $request->bio);
        $this->assertInstanceOf(ChatInviteLink::class, $request->invite_link);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = [
            'chat' => ['id' => '123', 'type' => 'supergroup'],
            'from' => ['id' => '456', 'is_bot' => false, 'first_name' => 'Requester'],
            'user_chat_id' => '789012345678',
            'date' => 1700000000,
        ];
        $request = ChatJoinRequest::fromArray($data);
        $this->assertInstanceOf(Chat::class, $request->chat);
        $this->assertInstanceOf(User::class, $request->from);
        $this->assertSame('789012345678', $request->user_chat_id);
        $this->assertNull($request->bio);
        $this->assertNull($request->invite_link);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'chat' => ['id' => '123', 'type' => 'supergroup'],
            'from' => ['id' => '456', 'is_bot' => false, 'first_name' => 'Requester'],
            'user_chat_id' => '789012345678',
            'date' => 1700000000,
            'bio' => 'test bio',
            'invite_link' => [
                'invite_link' => 'https://t.me/joinchat/abc123',
                'creator' => ['id' => '456', 'is_bot' => false, 'first_name' => 'Admin'],
                'creates_join_request' => true,
                'is_primary' => true,
                'is_revoked' => false,
            ]
        ];
        $request = ChatJoinRequest::fromArray($data);
        $this->assertSame($data, $request->toArray());
    }
}
