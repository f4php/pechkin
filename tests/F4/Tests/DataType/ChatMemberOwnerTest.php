<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatMemberOwner;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatMemberOwnerTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_member_owner_full.json');
        $chatMemberOwner = ChatMemberOwner::fromArray($data);

        $this->assertInstanceOf(ChatMemberOwner::class, $chatMemberOwner);
        $this->assertInstanceOf(User::class, $chatMemberOwner->user);
        $this->assertSame(true, $chatMemberOwner->is_anonymous);
        $this->assertSame('Admin', $chatMemberOwner->custom_title);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_member_owner_minimal.json');
        $chatMemberOwner = ChatMemberOwner::fromArray($data);

        $this->assertInstanceOf(ChatMemberOwner::class, $chatMemberOwner);
        $this->assertNull($chatMemberOwner->custom_title);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_member_owner_minimal.json');
        $chatMemberOwner = ChatMemberOwner::fromArray($data);
        $this->assertEquals([...$data, 'status' => 'creator'], $chatMemberOwner->toArray());
    }
}
