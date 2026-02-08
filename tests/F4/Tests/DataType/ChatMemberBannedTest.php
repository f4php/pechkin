<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatMemberBanned;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatMemberBannedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_member_banned_full.json');
        $chatMemberBanned = ChatMemberBanned::fromArray($data);

        $this->assertInstanceOf(ChatMemberBanned::class, $chatMemberBanned);
        $this->assertInstanceOf(User::class, $chatMemberBanned->user);
        $this->assertSame(1700172800, $chatMemberBanned->until_date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_member_banned_minimal.json');
        $chatMemberBanned = ChatMemberBanned::fromArray($data);
        $this->assertEquals([...$data, 'status' => 'kicked'], $chatMemberBanned->toArray());
    }
}
