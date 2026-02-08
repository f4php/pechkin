<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\ChatInviteLink;
use F4\Pechkin\DataType\ChatMember;
use F4\Pechkin\DataType\ChatMemberUpdated;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatMemberUpdatedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_member_updated_full.json');
        $chatMemberUpdated = ChatMemberUpdated::fromArray($data);

        $this->assertInstanceOf(ChatMemberUpdated::class, $chatMemberUpdated);
        $this->assertInstanceOf(Chat::class, $chatMemberUpdated->chat);
        $this->assertInstanceOf(User::class, $chatMemberUpdated->from);
        $this->assertNotNull($chatMemberUpdated->old_chat_member);
        $this->assertNotNull($chatMemberUpdated->new_chat_member);
        $this->assertInstanceOf(ChatInviteLink::class, $chatMemberUpdated->invite_link);
        $this->assertSame(1700000000, $chatMemberUpdated->date);
        $this->assertInstanceOf(ChatMember::class, $chatMemberUpdated->old_chat_member);
        $this->assertInstanceOf(ChatMember::class, $chatMemberUpdated->new_chat_member);
        $this->assertSame(true, $chatMemberUpdated->via_join_request);
        $this->assertSame(true, $chatMemberUpdated->via_chat_folder_invite_link);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_member_updated_minimal.json');
        $chatMemberUpdated = ChatMemberUpdated::fromArray($data);

        $this->assertInstanceOf(ChatMemberUpdated::class, $chatMemberUpdated);
        $this->assertNull($chatMemberUpdated->invite_link);
        $this->assertNull($chatMemberUpdated->via_join_request);
        $this->assertNull($chatMemberUpdated->via_chat_folder_invite_link);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_member_updated_minimal.json');
        $chatMemberUpdated = ChatMemberUpdated::fromArray($data);
        $this->assertEquals($data, $chatMemberUpdated->toArray());
    }
}
