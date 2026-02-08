<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatMemberLeft;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatMemberLeftTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_member_left_full.json');
        $chatMemberLeft = ChatMemberLeft::fromArray($data);

        $this->assertInstanceOf(ChatMemberLeft::class, $chatMemberLeft);
        $this->assertInstanceOf(User::class, $chatMemberLeft->user);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_member_left_minimal.json');
        $chatMemberLeft = ChatMemberLeft::fromArray($data);
        $this->assertEquals([...$data, 'status' => 'left'], $chatMemberLeft->toArray());
    }
}
