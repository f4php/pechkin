<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatMemberBanned;
use F4\Pechkin\DataType\User;

final class ChatMemberBannedTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'user' => [
                'id' => '123456789',
                'is_bot' => false,
                'first_name' => 'John',
            ],
            'until_date' => 1700000000,
        ];
        $member = ChatMemberBanned::fromArray($data);

        $this->assertInstanceOf(User::class, $member->user);
        $this->assertSame('123456789', $member->user->id);
        $this->assertSame(1700000000, $member->until_date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'user' => [
                'id' => '123456789',
                'is_bot' => false,
                'first_name' => 'John',
            ],
            'until_date' => 1700000000,
        ];
        $member = ChatMemberBanned::fromArray($data);
        $this->assertSame($data, $member->toArray());
    }
}
