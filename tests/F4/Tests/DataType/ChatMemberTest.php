<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatMember;
use F4\Pechkin\DataType\ChatMemberOwner;
use F4\Pechkin\DataType\ChatMemberAdministrator;
use F4\Pechkin\DataType\ChatMemberMember;
use F4\Pechkin\DataType\ChatMemberRestricted;
use F4\Pechkin\DataType\ChatMemberLeft;
use F4\Pechkin\DataType\ChatMemberBanned;

final class ChatMemberTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithCreatorStatus(): void
    {
        $data = [
            ...$this->loadFixture('chat_member_owner_full.json'),
            'status' => 'creator',
        ];
        $result = ChatMember::fromArray($data);
        $this->assertInstanceOf(ChatMemberOwner::class, $result);
    }

    public function testFromArrayWithAdministratorStatus(): void
    {
        $data = [
            ...$this->loadFixture('chat_member_administrator_full.json'),
            'status' => 'administrator',
        ];
        $result = ChatMember::fromArray($data);
        $this->assertInstanceOf(ChatMemberAdministrator::class, $result);
    }

    public function testFromArrayWithMemberStatus(): void
    {
        $data = [
            ...$this->loadFixture('chat_member_member_full.json'),
            'status' => 'member',
        ];
        $result = ChatMember::fromArray($data);
        $this->assertInstanceOf(ChatMemberMember::class, $result);
    }

    public function testFromArrayWithRestrictedStatus(): void
    {
        $data = [
            ...$this->loadFixture('chat_member_restricted_full.json'),
            'status' => 'restricted',
        ];
        $result = ChatMember::fromArray($data);
        $this->assertInstanceOf(ChatMemberRestricted::class, $result);
    }

    public function testFromArrayWithLeftStatus(): void
    {
        $data = [
            ...$this->loadFixture('chat_member_left_full.json'),
            'status' => 'left',
        ];
        $result = ChatMember::fromArray($data);
        $this->assertInstanceOf(ChatMemberLeft::class, $result);
    }

    public function testFromArrayWithKickedStatus(): void
    {
        $data = [
            ...$this->loadFixture('chat_member_banned_full.json'),
            'status' => 'kicked',
        ];
        $result = ChatMember::fromArray($data);
        $this->assertInstanceOf(ChatMemberBanned::class, $result);
    }

}
