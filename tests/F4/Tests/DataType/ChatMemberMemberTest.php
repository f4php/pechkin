<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatMemberMember;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatMemberMemberTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_member_member_full.json');
        $chatMemberMember = ChatMemberMember::fromArray($data);

        $this->assertInstanceOf(ChatMemberMember::class, $chatMemberMember);
        $this->assertInstanceOf(User::class, $chatMemberMember->user);
        $this->assertSame(1700172800, $chatMemberMember->until_date);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_member_member_minimal.json');
        $chatMemberMember = ChatMemberMember::fromArray($data);

        $this->assertInstanceOf(ChatMemberMember::class, $chatMemberMember);
        $this->assertNull($chatMemberMember->until_date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_member_member_minimal.json');
        $chatMemberMember = ChatMemberMember::fromArray($data);
        $this->assertEquals([...$data, 'status' => 'member'], $chatMemberMember->toArray());
    }
}
