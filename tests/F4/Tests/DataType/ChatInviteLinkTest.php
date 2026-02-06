<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatInviteLink;
use F4\Pechkin\DataType\User;

final class ChatInviteLinkTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'invite_link' => 'https://t.me/joinchat/abc123',
            'creator' => ['id' => '456', 'is_bot' => false, 'first_name' => 'Admin'],
            'creates_join_request' => true,
            'is_primary' => true,
            'is_revoked' => false,
            'name' => 'link_name',
            'expire_date' => 1798761600,
            'member_limit' => 15,
            'pending_join_request_count' => 2,
            'subscription_period' => 180,
            'subscription_price' => 2,
        ];
        $link = ChatInviteLink::fromArray($data);
        $this->assertSame('https://t.me/joinchat/abc123', $link->invite_link);
        $this->assertInstanceOf(User::class, $link->creator);
        $this->assertTrue($link->creates_join_request);
        $this->assertTrue($link->is_primary);
        $this->assertTrue($link->is_revoked);
        $this->assertSame('link_name', $link->name);
        $this->assertSame(1798761600, $link->expire_date);
        $this->assertSame(15, $link->member_limit);
        $this->assertSame(2, $link->pending_join_request_count);
        $this->assertSame(180, $link->subscription_period);
        $this->assertSame(2, $link->subscription_price);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = [
            'invite_link' => 'https://t.me/joinchat/abc123',
            'creator' => ['id' => '456', 'is_bot' => false, 'first_name' => 'Admin'],
            'creates_join_request' => true,
            'is_primary' => true,
            'is_revoked' => false,
        ];
        $link = ChatInviteLink::fromArray($data);
        $this->assertSame('https://t.me/joinchat/abc123', $link->invite_link);
        $this->assertInstanceOf(User::class, $link->creator);
        $this->assertTrue($link->creates_join_request);
        $this->assertTrue($link->is_primary);
        $this->assertTrue($link->is_revoked);
        $this->assertNull($link->name);
        $this->assertNull($link->expire_date);
        $this->assertNull($link->member_limit);
        $this->assertNull($link->pending_join_request_count);
        $this->assertNull($link->subscription_period);
        $this->assertNull($link->subscription_price);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'invite_link' => 'https://t.me/joinchat/abc123',
            'creator' => ['id' => '456', 'is_bot' => false, 'first_name' => 'Admin'],
            'creates_join_request' => true,
            'is_primary' => true,
            'is_revoked' => false,
            'name' => 'link_name',
            'expire_date' => 1798761600,
            'member_limit' => 15,
            'pending_join_request_count' => 2,
            'subscription_period' => 180,
            'subscription_price' => 2,
        ];
        $link = ChatInviteLink::fromArray($data);
        $this->assertSame($data, $link->toArray());
    }
}
