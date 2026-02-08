<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatInviteLink;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatInviteLinkTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_invite_link_full.json');
        $chatInviteLink = ChatInviteLink::fromArray($data);

        $this->assertInstanceOf(ChatInviteLink::class, $chatInviteLink);
        $this->assertInstanceOf(User::class, $chatInviteLink->creator);
        $this->assertSame('https://t.me/+abc123', $chatInviteLink->invite_link);
        $this->assertSame(false, $chatInviteLink->creates_join_request);
        $this->assertSame(true, $chatInviteLink->is_primary);
        $this->assertSame(false, $chatInviteLink->is_revoked);
        $this->assertSame('Test Name', $chatInviteLink->name);
        $this->assertSame(1700172800, $chatInviteLink->expire_date);
        $this->assertSame(100, $chatInviteLink->member_limit);
        $this->assertSame(3, $chatInviteLink->pending_join_request_count);
        $this->assertSame(2592000, $chatInviteLink->subscription_period);
        $this->assertSame(500, $chatInviteLink->subscription_price);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_invite_link_minimal.json');
        $chatInviteLink = ChatInviteLink::fromArray($data);

        $this->assertInstanceOf(ChatInviteLink::class, $chatInviteLink);
        $this->assertNull($chatInviteLink->name);
        $this->assertNull($chatInviteLink->expire_date);
        $this->assertNull($chatInviteLink->member_limit);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_invite_link_minimal.json');
        $chatInviteLink = ChatInviteLink::fromArray($data);
        $this->assertEquals($data, $chatInviteLink->toArray());
    }
}
